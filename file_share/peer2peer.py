import socket

def send_file(filename, host, port):
    # Create a TCP socket
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

    try:
        # Connect to the receiver
        sock.connect((host, port))

        # Open the file to be sent
        with open(filename, 'rb') as file:
            # Read and send the file in chunks
            for data in file:
                sock.sendall(data)

        print(f"File '{filename}' sent successfully.")
    finally:
        # Close the socket
        sock.close()

def receive_file(filename, port):
    # Create a TCP socket
    sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

    try:
        # Bind the socket to the port and start listening
        sock.bind(('', port))
        sock.listen(1)

        print("Waiting for a connection...")

        # Accept a connection from the sender
        connection, sender_address = sock.accept()

        print("Connected.")

        # Open a file to write the received data
        with open(filename, 'wb') as file:
            # Receive and write the data in chunks
            while True:
                data = connection.recv(1024)
                if not data:
                    break
                file.write(data)

        print(f"File '{filename}' received successfully.")
    finally:
        # Close the socket and the connection
        connection.close()
        sock.close()

# Prompt the user for the desired operation
option = input("Enter 'send' or 'receive': ")

if option == 'send':
    filename = input("Enter the filename to send: ")
    host = input("Enter the receiver's IP address: ")
    port = int(input("Enter the receiver's port: "))
    send_file(filename, host, port)
elif option == 'receive':
    filename = input("Enter the filename to receive: ")
    port = int(input("Enter the port to listen on: "))
    receive_file(filename, port)
else:
    print("Invalid option. Please choose 'send' or 'receive'.")
