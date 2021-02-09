## Story

*The story below is fictional, created only for this exam's purpose.*

Needs an internal tool as **Vehicles Page**. The **Vehicles Page** requires to _display a list of vehicles_ and also a way to easily _register a vehicle within the page_.

On **Vehicles Page**, one important information that we need to display for vehicles is the [engine displacement value](https://en.wikipedia.org/wiki/Engine_displacement). Usually cars and trucks are described using **liters** as measurement unit, but motorcycles are described using **cubic centimetres**. Some countries use **cubic inches**.

Due to the lack of validation on our application vehicle registration form, for years people provided all sort of different formats, such as "1L", "1.0L", "1.0", "1 L", "1000CC", "1000 CC". Some customers want to classify the vehicles by power rating and the lack of pattern makes it nearly impossible.

We realized that it does not make sense to force a specific unit, since customers that are registering motorcycles usually don't know the value in **liters**, and also people registering cars and trucks don't know the value in **cubic centimetres**. In some countries **cubic inches** is used for the same models registered with other units in other countries.

## Task

You need to write a simple **REST webservice application** (server) and a **single page application** (client), where the client will be allowed to register a vehicle specifying the engine displacement using different measurement units. The client can also see a list of all other vehicles already inserted, but after a vehicle is registered, it can't be modified or deleted.

The vehicle needs to contain the following information:
 - unique identifier
 - name
 - engine displacement
 - engine power
 - price
 - location

## REST Webservice Application Requirements
 - Create a **PHP** web service that has an endpoint to register a vehicle and an endpoint to fetch all the registered vehicles.
 - It should handle unusual cases when the client provide the engine displacement for a car in **cubic centimetres** or **cubic inches** instead **liters** should be tolaterated. This means that the unit itself is not directly related to the vehicle type, but is a separate context instead.
 - You are **NOT ALLOWED** to use any `full stack web frameworks` (e.g. Laravel, Symfony, Zend Framework). Any microframework, or library, or component (even if they're part of a `full stack` framework) are ok to use though (e.g. Silex, Eloquent, Symfony Components, Zend Components), as long as it is in PHP and can be installed with composer. We will be particularly interested in the way that measurement unit problem is solved, so be careful if you are using a library for this specific problem, because the library code will be considered.
 - You are free to use any storage type you prefer. Please provide instructions on how to create a schema if necessary.
 - It is necessary to provide unit tests.

## Single Page Application Requirements
 - The application must have a `vehicles page` that contains two views, the `vehicles list view` and the `vehicle creation form view` side by side.
 - The expected layout is in [vehicles_page.pdf](vehicles_page.pdf).
 - The `vehicles list view` should simply list all vehicles registered from your **REST Webservice Application**.
 - The `vehicle creation form view` should simply have the vehicles input fields needed to register vehicles and send them to register in your **REST Webservice Application**.
 - It is necessary to provide unit tests.
 - You are allowed to you use any Javascript Frontend Frameworks (Angular, React, Vue, etc).
 - Feel free to design the UI any way you think is clear and performant

# Notes
 - Docker configuration is provided only for your convenience. You can deliver your running application using Docker (which you are also free to modify the configuration and folder structure) or using also the internal PHP server, or any other tool you prefer, as long as you **provide clear instructions on how to run it**.
 - Git knowledge is required. Workflow is also evaluated, so having history is desirable. It is not required, but it is recommended that you push your changes as frequently as possible to the repository, and not only at the very end.
 - The repository write access will be removed and the code will be evaluated the way it is in the respository on the due date sent to you.
 - You are free to write the code the way you think it will be more clean and maintainable.
 - Use any tool you think make sense to ensure that good quality code is delivered.

## Evaluation process
 - We will read the code first. The criteria are ordered by importance (ranked highest to lowest).
  1. Code Quality
  2. Maintainability
  3. Code Design (procedural code = automatic fail)
  4. Has unit tests
  5. Task understanding
  6. Task completeness.
