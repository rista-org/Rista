<?php
class Users {
    private $connect;

    public function __construct($dbConnection) {
        $this->connect = $dbConnection;
    }

    public function fetch_data($contact) {
        $query = "SELECT * FROM users WHERE Contact = ?";

        if ($stmt = $this->connect->prepare($query)) {
            $stmt->bind_param('s', $contact);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
            return $data;
        } else {
            throw new Exception("Failed to prepare the SQL statement: " . $this->connect->error);
        }
    }
    public function fetch_photo($contact){
        $query = "SELECT * FROM profile WHERE Contact = ?";

        if ($stmt = $this->connect->prepare($query)) {
            $stmt->bind_param('i', $contact);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            throw new Exception("Failed to prepare the SQL statement: " . $this->connect->error);
        }
    }

    public function connected($contact){
        $status = 'Connected';
        $query = "SELECT * FROM connected WHERE Contact = ? and status = ?";
        if ($stmt = $this->connect->prepare($query)) {
            $stmt->bind_param('is', $contact, $status);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        } else {
            throw new Exception("Failed to prepare the SQL statement: " . $this->connect->error);
        }

    }
    public function requested($contact, $requestedTo){
        $query = "SELECT * FROM connected WHERE Contact = ? and RequestedTo = ?";
        if ($stmt = $this->connect->prepare($query)) {
            $stmt->bind_param('ii', $contact, $requestedTo);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        } else {
            throw new Exception("Failed to prepare the SQL statement: " . $this->connect->error);
        }
    }

    public function users_data($contact){
        $query = "SELECT * FROM users WHERE Contact != ?";

        if ($stmt = $this->connect->prepare($query)) {
            $stmt->bind_param('s', $contact);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            throw new Exception("Failed to prepare the SQL statement: " . $this->connect->error);
        }
    }

    public function users_photo($contact){
        $query = "SELECT * FROM profile WHERE Contact != ?";

        if ($stmt = $this->connect->prepare($query)) {
            $stmt->bind_param('s', $contact);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        } else {
            throw new Exception("Failed to prepare the SQL statement: " . $this->connect->error);
        }
    }
}
class Delete {
    private $connect;

    public function __construct($dbConnection) {
        $this->connect = $dbConnection;
    }

    // Method to delete from the 'connected' table
    public function ConnectedDelete($requestedTo, $contact) {
        $query = "DELETE FROM connected WHERE Contact = ? AND RequestedTo = ?";
        
        if ($stmt = $this->connect->prepare($query)) {
            // Use 'i' for integer types; adjust if necessary
            $stmt->bind_param('ii', $contact, $requestedTo);
            $stmt->execute();

            if ($stmt->error) {
                // Handle the error as needed
                echo "Error: " . $stmt->error;
            }

            $stmt->close(); // Always close the statement
        } else {
            // Handle the error if prepare() fails
            echo "Error preparing statement: " . $this->connect->error;
        }
    }

    // Method to delete from the 'notification' table
    public function NotificationDelete($sender, $contact) {
        $query = "DELETE FROM notification WHERE Sender = ? AND Contact = ?";
        
        if ($stmt = $this->connect->prepare($query)) {
            // Use 'i' for integer types; adjust if necessary
            $stmt->bind_param('ii', $sender, $contact);
            $stmt->execute();

            if ($stmt->error) {
                // Handle the error as needed
                echo "Error: " . $stmt->error;
            }

            $stmt->close(); // Always close the statement
        } else {
            // Handle the error if prepare() fails
            echo "Error preparing statement: " . $this->connect->error;
        }
    }
}
