<?php
// Full Name: Sayed Murtaza Fazily
// ==========================================
// Task 1: Create and Use a Class Constant
class Library {
    // This value is a constant because a library's maximum book limit is a fixed rule
    // that should never change during the execution of the program.
    public const MAX_BOOKS = 3;
}

// Display the class constant outside the class using the scope resolution operator
echo "Maximum books allowed: " . Library::MAX_BOOKS;
echo "<br><br>";


// ==========================================
// Task 2: Create a Static Property and Static Method
// ==========================================
class StudentCounter {
    // A public static property shared across the entire class
    public static $count = 0;

    // A static method to increase the count by 1 without needing an object instance
    public static function addStudent() {
        self::$count++;
    }
}

// Call the static method three times directly using the class name
StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();

// Display the final shared value
echo "Total students: " . StudentCounter::$count;
echo "<br><br>";


// ==========================================
// Task 3: Create an Abstract Class and Abstract Method
// ==========================================
// Abstract parent class defining a strict rule (template) for all vehicles
abstract class Vehicle {
    // Abstract method must be implemented by any child class
    abstract public function start();
}

// Child class Car extends Vehicle and implements the start method
class Car extends Vehicle {
    public function start() {
        echo "Car engine started.";
    }
}

// Child class Bike extends Vehicle and implements the start method
class Bike extends Vehicle {
    public function start() {
        echo "Bike started.";
    }
}

// Create objects for each class and call their start methods
$myCar = new Car();
$myCar->start(); // Output: Car engine started.

echo "<br>";

$myBike = new Bike();
$myBike->start(); // Output: Bike started.
?>