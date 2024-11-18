# String Calculator

## Before you start

* Try not to read the entire statement before starting, read little by little while you solve it.
* Do only one task at a time. The trick is to learn to work incrementally.
* Make sure to test only the correct entries. It is not necessary to test the incorrect entries for this kata.
  
## Desired functionality

1. Create a String Calculator with the method: int Add(string numbers)
    * The method parameter can contain 0, 1 or 2 numbers and will return their sum (for an empty string it will return 0). For example: "" or "1" or "1.2"
    * It starts with a simple test for an empty string and then for 1 and 2 numbers.
    * Remember to solve the problem in the simplest way possible so that it forces you to write the tests that you had not yet thought of.
    * Remember to refactor after each test is passed.
2. Allows the "Add" method to handle any amount of numbers.
3. Allows the "add" method to handle line breaks between numbers instead of using commas.
    * The following entry is correct: "1\n2,3" (the result will be 6)
    * The following entry is NOT correct: "1,\n" (no need to test it, just for clarification)
4. Supports different delimiters
    * To change a delimiter, the beginning of the string must contain a separate line that looks like  this: "//[delimiter]\n[numbers...]". For example: "//;\n1;2" should result in 3 where the default delimiter is ";".
    * The first line is optional. All existing scenarios so far must be supported.
5. Calling the "Add" method with negative numbers should throw an exception with the text "negatives not supported" and the negative number that was passed. If there are multiple negative numbers, print all of them in the exception message.
6. Numbers greater than 1000 should be ignored. For example "2,1001" will result in 2.
7. Delimiters can be of any length with the following format: "//[delimiter]\n". For example: "//[ ]\n1 2***3" must result in 6.
8. Allows multiple delimiters as follows: "//[delim1][delim2]\n". For example: "//[ ][%]\n1 2%3" must result in 6.
9. Make sure you can handle delimiters of any length greater than one character.

## Credits

[Kata original](http://osherove.com/tdd-kata-1/)
