## Installation within a Magento 2 site

1) Clone https://github.com/sneig/Tracker.git
2) Move code to app/code/ directory of your project
3) In a command line:

```bash

php bin/magento setup:upgrade
```

### Configuration

1) Login to admin
2) Stores -> configuration -> Alex -> Tracker: 
 - Enable - Yes
 - Mode - Async. MysqlMQ will be used. Sync mode for testing only
3) Cron should be enabled in your environment 
4) In app/etc/env.php configure consumers cron:

```
    'cron_consumers_runner' => [
        'consumers' => [
            'track_product.action',
        ]
    ]
``` 

### API usage

1) Create a new integration in admin -> system -> integrations
2) Select "Tracking Records" resource

```
    GET:  <base_url>/rest/V1/tracking 
```