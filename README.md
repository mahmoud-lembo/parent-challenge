## Challenge Idea

We have two data providers in json folder we need to read and make some filter operations on them to get the result

- it list all users which combine transactaions from all the available providerDataProviderX and DataProviderY
- its able to filter resullt by payment providers for example /api/v1/users?provider=DataProviderX
- its able to filter result by three statusCode (authorised, decline, refunded) for example /api/v1/users?statusCode=authorised (it return from all providers that have status code authorised)
- its able to filer by amount range for example /api/v1/users?balanceMin=10&balanceMax=100
- its able to filer by currency for example /api/v1/users?currency=USD
- its able to combine all this filters together
- the result can be viewed as json from /api/v1/users
- the result can be viewed using gui from /api/v1/users?gui
