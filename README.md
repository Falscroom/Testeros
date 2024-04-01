
*Main points:*
1) Layered architecture. 3 layers for now.
2) Rich model.

How to:

*Set up*

```shell
docker compose up -d
```

```shell
docker compose exec app composer install
```

```shell
docker compose exec app php bin/console doc:mig:mig
```

**Test API Documentation**

Welcome to the Test API, which facilitates creating, managing, and finalizing tests with questions and answers. This document outlines the API endpoints available for interacting with the test system.
Endpoints

**Start a New Test**

Initiates a new test instance.

    HTTP Method: POST
    Endpoint: /api/start
    Request Body: None
    Response: A JSON object containing the ID of the newly created test.

Example Response:
```json
{
  "testId": 1
}
```

**Answer a Question**

Submits answers for the current question in a test.

    HTTP Method: PATCH
    Endpoint: /api/{id}/answer
    URL Parameters:
        id - The ID of the test.
    Request Body: A JSON object with an array of answer IDs selected by the user.

Example Request Body:
```json
{
  "answerIds": [2, 3]
}
```

Response is next question or null if test finished.

Example Response:
```json
{
  "text": "1 + 1 = ",
  "answers": [
    {
      "id": 49,
      "text": "2"
    },
    ...
  ]
}
```

**Get Current Question**

Retrieves the current question of the test.

    HTTP Method: GET
    Endpoint: /api/{id}/current
    URL Parameters:
        id - The ID of the test.
    Request Body: None
    Response: A JSON object representing the current question along with possible answers.

Example Response:
```json
{
  "text": "1 + 1 = ",
  "answers": [
    {
      "id": 49,
      "text": "2"
    },
    ...
  ]
}
```

**Get Test Results**

Retrieves the results of a completed test.

    HTTP Method: GET
    Endpoint: /api/{id}/results
    Description: Provides a detailed summary of the test results, including questions, selected answers, and correctness.
    URL Parameters:
        id - The ID of the test.
    Request Body: None

Example Response:
```json
{
  "questions": [
    {
      "text": "2 + 2 = ",
      "isAnsweredCorrectly": true,
      "answers": [
        {
          "text": "10",
          "isSelected": false,
          "isCorrect": false
        },
        ...
      ]
    },
    ...
  ],
  "score": 80,
  "correctAnswers": 8,
  "wrongAnswers": 2
}
```

