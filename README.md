The Online Bakery Challenge
===========================


 ![Cake](./img/cake.png)

Create a small application using Silex or plain PHP.  
https://silex.symfony.com/doc/2.0/

You find everything you need in this repository. To run the application either user `composer run`  
or your local LAMP/WAMP stack. If you are using windows, you might have to replace `127.0.0.1` with `localhost` in `composer.json`.  


About the challenges:
---------------------
Feel free to rename the existing files and classes and function however you like.
It's important that you like the structure once you are done. Try to make your implementation easy to read and extend.
If you don't like the starter we provided for you, just start from scratch.

If possible, keep track of your progress using git.
If possible, create unit tests for your code.

If you are not yet familiar with the specificities of PHP 7.1, feel free to remove all syntax that seems strange to you.

HINT: Routes can be found in Optimy\OnlineBakery\Service::setupRouting  



Cakes
-----
Your bakery sells 4 types of cakes:

**Cupcakes:**
 - Pastry: Sponge
 - Topping: Icing, Butter crème or whipped creme

**Eclairs:**
 - Pastry: choux pastry
 - Topping: Chocolate
 - Filling: Butter crème or whipped creme

**Mille-feuilles:**
 - Pastry: puff pastry
 - Topping: Fruits
 - Filling: Butter crème or whipped creme

**Cheesecake:**
 - Pastry: shortcrust
 - Filling: cheese cake crème (secret recipe)

All cremes (Butter crème, whipped crème and cheese cake crème) can come plain or flavored (eg. Coffee, Lemon, Orange, Vanilla, …)  


Challenges:
-----------
Your online bakery has the following REST endpoints:

1) **GET /api/cakes**  
Returns 10 random cakes (as JSON) based on the compositions described above,
to give your customers some inspirations for their orders  

2) **GET /api/cakes/{type}**  
Returns 10 random cakes (as JSON) of a specified type, based on the compositions described above  

3) **POST /api/cakes/order**  
This endpoint allows your customers to order a cake of their choice. The order must be validated based on the allowed compositions.
The response either returns the accepted order as JSON or an error with a message stating the reason of rejecting the order and the appropriate status code.    

If you feel fancy:

4) **GET /api/cakes/order/{order_id}**  
Change the endpoint you just created to use the InFileOrderRepository provided for you. Make sure the order resource returned contains its ID.
Then create a corresponding GET endpoint to retrieve a customers order by ID.  

5) **PUT /api/cakes/order/{order_id}**  
Your bakers will need to be able to change the status of the orders. Provide an endpoint for this. Also, your customers
would like to keep track of the status of their order. Change the existing endpoint accordingly.  

How to run this project:
------------------------
Please use 'composer install' to install dependencies.

If every thing is OK, then use 'php -S localhost:8888 -t public' to run webserver.

Test has been done with Postman.

For **POST /api/cakes/order**:

request should be like this:
[
  {
    "type": "CHEESECAKE",
    "pastry": "SHORTCRUST",
    "topping": null,
    "filling": "CHEESE CAKE CREME",
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "ECLAIRS",
    "pastry": "CHOUX PASTRY",
    "topping": "CHOCOLATE",
    "filling": "BUTTER CREME",
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "ECLAIRS",
    "pastry": "CHOUX PASTRY",
    "topping": "CHOCOLATE",
    "filling": "BUTTER CREME",
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "ECLAIRS",
    "pastry": "CHOUX PASTRY",
    "topping": "CHOCOLATE",
    "filling": "BUTTER CREME",
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "CUPCAKES",
    "pastry": "SPONGE",
    "topping": "ICING",
    "filling": null,
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "ECLAIRS",
    "pastry": "CHOUX PASTRY",
    "topping": "CHOCOLATE",
    "filling": "BUTTER CREME",
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "CHEESECAKE",
    "pastry": "SHORTCRUST",
    "topping": null,
    "filling": "CHEESE CAKE CREME",
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "CHEESECAKE",
    "pastry": "SHORTCRUST",
    "topping": null,
    "filling": "CHEESE CAKE CREME",
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "CUPCAKES",
    "pastry": "SPONGE",
    "topping": "ICING",
    "filling": null,
    "cremeFlavor": "PLAIN"
  },
  {
    "type": "MILLE-FEUILLES",
    "pastry": "PUFF PASTRY",
    "topping": "FRUITS",
    "filling": "BUTTER CREME",
    "cremeFlavor": "PLAIN"
  }
]
