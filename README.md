## Kontist Customer API Test


### Summary
Create an api service with CRUD opporation for to manage kontist customers

### Features
- JWT auth
- Token based request authentication
- Database persistence
- Request Validation
- Json API response
- TDD


#### 4 Step setup:
- clone repo
- cd into folder and run ```docker-compose up```
- run ```docker exec  -it kontist_api_server bash``` to get into the dev ennviromennt
- cd into ```/web``` and run ```composer install``` to pull dependencies
- run ```php console kontist:migrate``` to run database migration

#### Run Test:
  - while in the docker dev ennviromennt run ```./vendor/bin/phpunit``` 

#### Get Started:
- Open [postman](https://www.getpostman.com/apps). or any api client to test the api functionality
- Import [postman api collection](https://www.getpostman.com/collections/b5f7da2dc2d9f65f3cde). or any api client to test the api functionality
- Visit http://localhost to see the contents of the web container and develop your application.

#### Console App:
- while in the docker dev ennviromennt run ```php console``` to get the list of commands
- run ```php console kontist:migrate``` to run database migration
- run ```php console kontist:drop-table``` to drop  Drop database table
- run ```php console kontist:seed``` to seed database table

API documentation => https://documenter.getpostman.com/view/1035891/RztppnBu
