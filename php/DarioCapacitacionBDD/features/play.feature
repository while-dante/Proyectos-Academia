Feature: Play
In order to play
As a player
I need to be able to mark a cell

Rules:
- The cell must be empty
- The game must not have finished

Scenario: the first turn
    Given an empty board
    When I select cell 1 1
    Then the board should be marked with an 'X' on cell 1 1

Scenario: trying to mark an already marked cell
    Given an empty board
    When I select cell 1 1
    And I select cell 1 1
    Then the board should be marked with an 'X' on cell 1 1

Scenario: the first two turns
    Given an empty board
    When I select cell 1 1
    And I select cell 0 0
    Then the board should be marked with an 'X' on cell 1 1
    And the board should be marked with an 'O' on cell 0 0

Scenario: not a tie yet
    Given an empty board
    Then there should not be a tie

Scenario: playing 8 turns without winner
    Given an empty board
    When I select cell 0 0
    And I select cell 0 2
    And I select cell 0 1
    And I select cell 1 0
    And I select cell 1 1
    And I select cell 2 2
    And I select cell 1 2
    And I select cell 2 1
    Then there should not be a tie

Scenario: playing 9 turns without winner, a tie
    Given an empty board
    When I select cell 0 0
    And I select cell 0 2
    And I select cell 0 1
    And I select cell 1 0
    And I select cell 1 1
    And I select cell 2 2
    And I select cell 1 2
    And I select cell 2 1
    And I select cell 2 0
    Then there should be a tie

Scenario: X wins by row
    Given an empty board
    When I select cell 1 1
    And I select cell 0 1
    And I select cell 1 2
    And I select cell 0 0
    And I select cell 1 0
    Then X should have won
    And O should not have won
    And there should not be a tie

Scenario: X wins by column
    Given an empty board
    When I select cell 1 2
    And I select cell 0 1
    And I select cell 0 2
    And I select cell 0 0
    And I select cell 2 2
    Then X should have won
    And O should not have won
    And there should not be a tie

Scenario: X wins by diagonal
    Given an empty board
    When I select cell 1 1
    And I select cell 0 1
    And I select cell 0 2
    And I select cell 0 0
    And I select cell 2 0
    Then X should have won
    And O should not have won
    And there should not be a tie

Scenario: game has not ended yet
    Given an empty board
    When I select cell 1 1
    And I select cell 0 0
    And I select cell 2 1
    And I select cell 0 1
    And I select cell 2 2
    Then the game should not have ended
    And O should not have won
    And X should not have won
    And there should not be a tie

Scenario: O wins AND game ends
    Given an empty board
    When I select cell 1 1
    And I select cell 0 0
    And I select cell 2 1
    And I select cell 0 1
    And I select cell 2 2
    And I select cell 0 2
    Then O should have won
    And X should not have won
    And there should not be a tie
    And the game should have ended

Scenario: trying to play after the game is over
    Given an empty board
    When I select cell 1 1
    And I select cell 0 0
    And I select cell 2 1
    And I select cell 0 1
    And I select cell 2 2
    And I select cell 0 2
    And I select cell 1 0
    Then the board should be marked with an 'X' on cell 1 1
    And the board should be marked with an 'O' on cell 0 0
    And the board should be marked with an 'X' on cell 2 1
    And the board should be marked with an 'O' on cell 0 1
    And the board should be marked with an 'X' on cell 2 2
    And the board should be marked with an 'O' on cell 0 2
    And the game should have ended
    And the board should not be marked on cell 1 0

