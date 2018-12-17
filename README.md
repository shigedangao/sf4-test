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