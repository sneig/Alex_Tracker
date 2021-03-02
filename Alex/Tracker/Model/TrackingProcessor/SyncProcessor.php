<?php

namespace Alex\Tracker\Model\TrackingProcessor;

use Alex\Tracker\Api\Data\TrackerInterface;
use Alex\Tracker\Api\Data\TransferInterface;
use Alex\Tracker\Api\TrackerRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\SerializerInterface;
use Alex\Tracker\Model\TrackerFactory;

class SyncProcessor implements SyncProcessorInterface
{
    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var TrackerRepositoryInterface
     */
    private $trackerRepository;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var TrackerFactory
     */
    private $trackerFactory;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * SyncProcessor constructor.
     *
     * @param Curl                       $curl
     * @param TrackerRepositoryInterface $trackerRepository
     * @param SerializerInterface        $serializer
     * @param TrackerFactory             $trackerFactory
     * @param string                     $apiUrl
     */
    public function __construct(
        Curl $curl,
        TrackerRepositoryInterface $trackerRepository,
        SerializerInterface $serializer,
        TrackerFactory $trackerFactory,
        string $apiUrl = 'https://supertracking.view.agentur-loop.com/trackme'
    ) {
        $this->trackerRepository = $trackerRepository;
        $this->curl = $curl;
        $this->serializer = $serializer;
        $this->trackerFactory = $trackerFactory;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param TransferInterface $transfer
     *
     * @return bool
     */
    public function execute(TransferInterface $transfer): bool
    {
        $this->curl->addHeader('Content-Type', 'application/json');
        $this->curl->post(
            $this->apiUrl,
            $this->serializer->serialize([
                'price' => $transfer->getPrice(),
                'sku' => $transfer->getSku()
            ])
        );

        $result = $this->curl->getBody();
        $resultArray = $this->serializer->unserialize($result);

        if ($resultArray) {
            $this->validateResponse($resultArray);
            $this->processResponse($resultArray, $transfer->getSku());
        }
        return true;
    }

    /**
     * @param array  $resultArray
     * @param string $sku
     *
     * @return void
     */
    private function processResponse(array $resultArray, string $sku)
    {
        /**
         * @var $trackerModel TrackerInterface
         */
        $trackerModel = $this->trackerFactory->create();
        $trackerModel->setTrackingCode($resultArray['code']);
        $trackerModel->setTrackingMessage($resultArray['message']);
        $trackerModel->setSku($sku);
        $this->trackerRepository->save($trackerModel);
    }

    /**
     * @param array $response
     *
     * @throws LocalizedException
     * @return void
     */
    private function validateResponse(array $response)
    {
        if (!isset($response['code'])) {
            throw new LocalizedException(__('Not valid response'));
        }
    }
}
