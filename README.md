# kompletecare-tha

p align="center">
<a href="https://github.com/symfony/symfony/actions"><img src="https://github.com/symfony/symfony/actions/workflows/unit-tests.yml/badge.svg?branch=6.2" alt="Build Status"></a>
<a href="https://packagist.org/packages/symfony/symfony"><img src="https://img.shields.io/packagist/l/symfony/symfony" alt="License"></a>
</p>

## About This Project

> Kompletecare Backend THA.


## Installation
<p>Clone this Repository with</p>

> To ease with setup stress, please use docker

```bash
git clone https://github.com/celxkodez/internet-projects-test.git 
```
navigate to the project directory And Execute If You're on a
Unix Machine.

```bash
    cp .env.example .env
```

Otherwise, Please copy the content of .env.example and place it in .env 
file.

#### Regular Setup

Replace the Values in .env file to your credentials

execute 

install application dependencies.
```bash
    composer install
```
generate project key.
```bash
    php artisan artisan key:generate
```
migrate database and seed database with test data.
```bash
    php artisan migrate --seed
```
to run the application tests, use.
```bash
    php artisan test
```
bootup local server for development
```bash
    php artisan serve
```

#### with docker
<p>On the Project root directory, run the commands</p>

```bash
    make setup-application
```
```bash
    make migrate-database
```
The above commands will install all dependency and perform all necessary
application setup processes.

to seed the database, simply use
```bash
    make artisan-command p=db:seed
```
<hr>


after that, visit you can view the application on your local machine
with http://127.0.0.1:8000/graphiql or http://localhost:8000/graphiql

Run 
```angular2html
    query {
      users {
        data {
          email
        }
      }
    }
```
To get a sample user for your test

replace user email with '$email'
```angular2html
    mutation {
      login(email: "$email", password: "password") {
        token
        token_type
        user {
          id
        }
      }
    }
```
> All seeded User password is 'password'

To query investigation type, use

```angular2html
    query {
      investigationGroups {
        id
        name
        subgroup 
        children {
          id
          name
          subgroup
        }
      }
    }
```
> note: aside the auth and users endpoints, every other endpoints
> are secured.
> So please replace the token from the login endpoint with Bearer
> token; e.g.

```angular2html
    {
      "Authorization": "Bearer 4|5dJ3MFJMaQqYXzAniwXS5BROXFPCo8JrgGHgqaFW"
    }
```

update the medical record with the values gotten from the
`investigationGroups` query, e.g

`mutation`

```angular2html
    mutation($input: MedicalRecordInput!) {
      addMedicalRecord(input: $input) {
        id
        consultation {
          title
        }
      }
    }
```
`input`

```angular2html
    {
        "input": {
            "consultation_id": 1,
            "investigations": [
                1,4,6,7,3,5
            ]
        }
    }
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
