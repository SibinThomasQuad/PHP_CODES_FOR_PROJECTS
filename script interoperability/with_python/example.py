# example_script.py

import sys

if __name__ == "__main__":
    # Get command-line arguments
    arguments = sys.argv[1:]

    # Print the arguments
    print("Received arguments:", arguments)

    # You can perform any other processing here based on the arguments
    # For example, calculate the sum of numeric arguments
    numeric_arguments = [float(arg) for arg in arguments if arg.isdigit() or (arg[0] == '-' and arg[1:].isdigit())]
    sum_numeric_arguments = sum(numeric_arguments)
    print("Sum of numeric arguments:", sum_numeric_arguments)
