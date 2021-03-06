Feature: Condition Product belong category tree exists
  Scenario: Get product belong category tree exists condition
    When I send a GET request to "/api/v1/en/conditions/PRODUCT_BELONG_CATEGORY_TREE_CONDITION"
    Then the response status code should be 401

  Scenario: Get product belong category tree exists condition
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a GET request to "/api/v1/en/conditions/PRODUCT_BELONG_CATEGORY_TREE_CONDITION"
    Then the response status code should be 200

  Scenario: Create category tree
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a POST request to "/api/v1/en/trees" with body:
      """
      {
        "code": "TREE_@@random_code@@",
        "name": {
          "de": "Test tree1 de",
          "en": "Test tree1 en",
          "pl_PL": "Test tree1 PL"
        }
      }
      """
    Then the response status code should be 201
    And store response param "id" as "category_tree1"

  Scenario: Create category tree
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a POST request to "/api/v1/en/trees" with body:
      """
      {
        "code": "TREE_@@random_code@@",
        "name": {
          "de": "Test tree2 de",
          "en": "Test tree2 en",
          "pl_PL": "Test tree2 PL"
        }
      }
      """
    Then the response status code should be 201
    And store response param "id" as "category_tree2"

  Scenario: Post new BELONG_TO product category tree exists condition set
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a POST request to "/api/v1/en/conditionsets" with body:
      """
        {
          "conditions": [
            {
              "type": "PRODUCT_BELONG_CATEGORY_TREE_CONDITION",
              "operator": "BELONG_TO",
              "tree": [
                "@category_tree1@",
                "@category_tree2@"
              ]
            }
          ]
        }
      """
    Then the response status code should be 201

  Scenario: Post new NOT_BELONG_TO product category tree exists condition set
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a POST request to "/api/v1/en/conditionsets" with body:
      """
        {
          "conditions": [
            {
              "type": "PRODUCT_BELONG_CATEGORY_TREE_CONDITION",
              "operator": "NOT_BELONG_TO",
              "tree": [
                "@category_tree1@"
              ]
            }
          ]
        }
      """
    Then the response status code should be 201

  Scenario: Post new fail condition operator
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a POST request to "/api/v1/en/conditionsets" with body:
      """
        {
          "conditions": [
            {
              "type": "PRODUCT_BELONG_CATEGORY_TREE_CONDITION",
              "operator": "x",
              "tree": [
                "@category_tree1@"
              ]
            }
          ]
        }
      """
    Then the response status code should be 400

  Scenario: Post new fail condition category tree doesn't exist
    Given I am Authenticated as "test@ergonode.com"
    And I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a POST request to "/api/v1/en/conditionsets" with body:
      """
        {
          "conditions": [
            {
              "type": "PRODUCT_BELONG_CATEGORY_TREE_CONDITION",
              "operator": "NOT_BELONG_TO",
              "tree": [
                "@@random_uuid@@"
              ]
            }
          ]
        }
      """
    Then the response status code should be 400
