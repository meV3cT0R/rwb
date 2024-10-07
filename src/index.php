<?php
    // logMessage("inside src/index.php");




    try {
        $dbConnection = (new DB())->connect();

        $cs = new CountryDAO($dbConnection);
        // $cs->postCountry(new Country("Germany"));
        // logMessage(implode($cs->getCountries()));
        $updatedCountry = new Country(null,"Poland");
        // $updatedCountry->setId(5);
        // $cs->updateCountry($updatedCountry);
        // logMessage( implode($cs->getCountries()));
        $ss = new StateDAO($dbConnection);
        // $ss->postState(new State(null,"california",new Country(6,"USA")));
        // logMessage( implode($ss->getStates()));
        // logMessage( $ss->getStateById(id: 1));
        $ss->updateState(new State(2,"texas",new Country(6)));
        // logMessage( implode($ss->getStates()));

        // $updatedCountry = new Country("Poland");
        // $updatedCountry->setId(5);
        // $cs->updateCountry($updatedCountry);
        // echo implode($ss->getStates());

        $cityService = new CityDAO($dbConnection,$cs,$ss);
        // logMessage(implode( $cityService->getCities()));
        // logMessage($cityService->getCityById(id: 1));
        // $cityService->updateCity(new City(1,"Kyoto",new Country(1) ));
        // logMessage($cityService->getCityById(id: 1));
        // $cityService->postCity(new City(null,"tokyo",new Country(1)));
        // logMessage(implode( $cityService->getCities()));
    } catch(Exception $e) {
        logMessage("". $e->getMessage());
    }

