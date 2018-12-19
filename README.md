## SF4-test

Testing symfony 4 with GraphQL

## Install

- Create a copy of the ````env.dist```` file and rename it to ```.env```
- Update the database settings
- Run ````composer install````
- Run ````php bin/console server:run````
- Run ```php bin/console doctrine:schema:validate```

if it's ok run this command

```php bin/console doctrine:schema:update --force```

## GraphQL

This project use the OverBlog GraphQL bundle. You can debug the graphql using the **http://localhost:8000/graphiql** endpoint

### GraphQL endpoint

- Example of queries are available in the ```config/graphql/query/query.example.txt```
- Example of mutation are available in the ```config/graphql/mutation/mutation.txt```

### Usage of graphiql

If you want to use graphiql. Enable the graphql endpoint w/o security. E.g below:

```yaml 
access_control:
    - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
    #- { path: ^/api/graphql, roles: [ROLE_USER, ROLE_ADMIN] }
    - { path: ^/api/graphql, roles: IS_AUTHENTICATED_ANONYMOUSLY }
```