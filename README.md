## Kontist API Test


### Summary
The requirement / instructions for this test can be found in the readme file. This is an additional documentation to give understand.


#### Please Watch before getting started => ​https://www.youtube.com/watch?v=bJ4pyjZUjok


#### 4 Step setup:
- clone repo
- cd into folder and run ```docker-compose up```
- run ```docker exec  -it emeka-osuagwu-api-test_php_1 bash``` to get into the dev ennviromennt
- cd into ```/web``` and run ```composer install``` to pull dependencies
- run ```php console hf:migrate``` to run database migration

#### Run Test:
  - while in the docker dev ennviromennt run ```./vendor/bin/phpunit``` 


#### Get Started:
- Open [postman](https://www.getpostman.com/apps). or any api client to test the api functionality
- Visit http://localhost to see the contents of the web container and develop your application.

#### Console App:
- while in the docker dev ennviromennt run ```php console``` to get the list of commands
- run ```php console hf:migrate``` to run database migration
- run ```php console hf:drop-table``` to drop  Drop database table
- run ```php console hf:seed``` to seed database table

API documentation => ​https://documenter.getpostman.com/view/1035891/RznBMfb5




