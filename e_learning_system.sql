-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 02:52 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `title`, `description`, `price`, `created_at`) VALUES
(0, 'Core Java', 'Core Java is the basic part of Java used for general programming. It covers OOP concepts, basic syntax, data types, control structures, classes, and objects. It includes essential features like multi-threading, exception handling, and the Collections framework. Core Java is the foundation for writing standard desktop and simple server-side applications, providing tools like the JVM, JRE, and JDK for developing and running Java programs.', 1500.00, '2024-11-19 02:48:03'),
(1, 'Basic C', 'C is a procedural programming language known for its efficiency and low-level memory access. It uses variables, functions, and control structures like loops and conditionals. C allows direct memory manipulation with pointers, making it ideal for system programming and embedded applications.', 0.00, '2024-11-16 18:26:37'),
(2, 'PHP', 'PHP is a server-side scripting language used for web development. It allows embedding in HTML and is commonly used to build dynamic websites, interact with databases, and handle forms and sessions. PHP is open-source, platform-independent, and widely supported.', 1000.00, '2024-11-16 18:27:55'),
(3, 'PYTHON', 'Python is a high-level, interpreted programming language known for its simplicity and readability. It supports multiple programming paradigms, including procedural, object-oriented, and functional programming. Python is widely used for web development, data analysis, machine learning, automation, and more due to its vast libraries like NumPy, pandas, and TensorFlow. Its versatility and beginner-friendly syntax make it a popular choice for developers and learners.', 3000.00, '2024-12-05 12:55:38'),
(4, 'REACT JS', 'ReactJS is a JavaScript library for building fast and interactive user interfaces, developed by Facebook. It uses a component-based architecture and a virtual DOM for efficient rendering. React is widely used for single-page applications (SPAs) and allows developers to build reusable UI components. Its flexibility and ease of integration make it popular for modern web development.', 2000.00, '2024-12-05 12:58:28'),
(5, 'CPP', 'C++ is a high-performance programming language that extends C by adding object-oriented features like classes and inheritance. It is widely used for system software, game development, and competitive programming due to its speed and efficiency. C++ supports multiple programming paradigms, including procedural, object-oriented, and generic programming.', 0.00, '2024-12-05 13:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollments`
--

CREATE TABLE `course_enrollments` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_enrollments`
--

INSERT INTO `course_enrollments` (`user_id`, `course_id`) VALUES
(1, 2),
(1, 2),
(3, 0),
(4, 0),
(5, 3),
(5, 4),
(8, 4),
(9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_title` varchar(255) NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`lesson_id`, `course_id`, `lesson_title`, `video_url`, `notes`) VALUES
(6, 1, 'Variable in C', 'https://www.youtube.com/watch?v=dhh5lrXXXYw&t=4s', 'A variable in C is a named memory location used to store data that can be modified during program execution.\r\n\r\nConditions for Declaring Variables:\r\n1. Data Type Specification: A variable must have a valid data type (`int`, `char`, `float`, etc.).\r\n2. Unique Name: The variable name should be unique within its scope.\r\n3. Valid Identifier:\r\n   - Must start with a letter (A-Z, a-z) or an underscore (`_`).\r\n   - Subsequent characters can be letters, digits (0-9), or underscores.\r\n   - No special characters (`@`, `#`, `$`, etc.) or spaces allowed.\r\n4. Cannot Use Reserved Keywords: Names like `int`, `return`, etc., cannot be used as variable names.\r\n5. Initialization (optional): You can assign a value when declaring:\r\n   ```c\r\n   int count = 5;\r\n   ```\r\n\r\n### Example:\r\n```c\r\nint age;      // Valid declaration\r\nfloat salary; // Valid declaration\r\nchar grade = \'A\'; // Declaration with initialization\r\n``` \r\n\r\nThese rules ensure that the variable is properly defined and can be used in the program.'),
(8, 1, 'data type in ', 'https://www.youtube.com/watch?v=NyT9vvSBoeo', 'In C, data types specify the type of data that a variable can hold. They help the compiler understand how much memory to allocate for the variable and what kind of operations can be performed on it. \r\n\r\nMain Data Types in C:\r\n\r\n1. Basic Data Types:\r\n   - int: Used for integers (whole numbers).\r\n     - Example: `int num = 10;`\r\n   - float: Used for single-precision floating-point numbers.\r\n     - Example: `float salary = 2500.50;`\r\n   - double: Used for double-precision floating-point numbers (more precision than `float`).\r\n     - Example: `double pi = 3.14159265359;`\r\n   - char: Used for single characters.\r\n     - Example: `char letter = \'A\';`\r\n\r\n2. Derived Data Types:\r\n   - array: Collection of elements of the same type.\r\n   - pointer: Used to store the memory address of another variable.\r\n   - structure` (`struct`): Used to group different types of variables.\r\n   - union: Similar to `struct` but shares memory among its members.\r\n   - enum: Used to define an enumeration type for naming integer constants.\r\n\r\n3. Void Data Type:\r\n   - void: Indicates no value. Commonly used with functions that do not return a value.\r\n     - Example: `void functionName() { /* code */ }`\r\n\r\n4. Modifiers:\r\n   - short, long, signed, and unsigned are type modifiers that change the properties of basic data types.\r\n     - Example: `unsigned int num = 300;`\r\n     - Example: `long double precisionValue = 123.456789;`\r\n\r\nExample of Variable Declarations:\r\nint age = 25;\r\nfloat height = 5.9;\r\ndouble distance = 12345.6789;\r\nchar initial = \'J\';\r\nunsigned int positiveNumber = 100;\r\n```\r\n\r\nEach data type is chosen based on the kind of data you need to store and the precision required.'),
(9, 2, 'Introduction to PHP', 'https://www.youtube.com/watch?v=KBT2gmAfav4', 'PHP (Hypertext Preprocessor) is a popular server-side scripting language widely used for web development. It was originally created in 1994 by Rasmus Lerdorf and has evolved significantly over the years. PHP is embedded within HTML and is known for its simplicity and flexibility in creating dynamic web pages.\r\n\r\nKey features of PHP:\r\n- Server-side Execution: PHP code runs on the server and outputs HTML to the client, enabling dynamic content.\r\n- Open-source: PHP is free to use and has a large community that contributes to its development and support.\r\n- Cross-platform: It runs on various operating systems such as Windows, Linux, and macOS.\r\n- Database Integration:PHP works well with databases like MySQL, PostgreSQL, and SQLite, making it ideal for building data-driven web applications.\r\n- Ease of Learning: Its syntax is relatively simple, making it beginner-friendly.\r\n\r\nPHP is used to build everything from simple websites to complex web applications, such as content management systems (e.g., WordPress), e-commerce platforms, and more. It can be combined with front-end technologies like HTML, CSS, and JavaScript for complete web solutions.'),
(11, 0, 'Introduction to Core Java', 'https://www.youtube.com/watch?v=mAtkPQO1FcA', 'Java is a high-level, object-oriented programming language developed by Sun Microsystems (now owned by Oracle) in 1995. It is known for its **\"write once, run anywhere\"** capability, meaning code compiled in Java can run on any device with a Java Virtual Machine (JVM). Java is widely used for building web applications, mobile apps, desktop applications, and enterprise software due to its platform independence, security features, and robustness. It supports features like automatic memory management, a rich standard library, and multi-threading.'),
(12, 0, 'data type in java', 'https://www.youtube.com/watch?v=UwpXXiGdlOE', '### Data Types in Java\r\n\r\nJava has two main categories of data types:\r\n\r\n---\r\n\r\n#### **1. Primitive Data Types**  \r\nSimple data types that store single values:  \r\n\r\n| **Type**   | **Size**  | **Example Values**     |\r\n|------------|-----------|------------------------|\r\n| `byte`     | 1 byte    | -128 to 127            |\r\n| `short`    | 2 bytes   | -32,768 to 32,767      |\r\n| `int`      | 4 bytes   | -2¹³¹ to 2³¹-1         |\r\n| `long`     | 8 bytes   | -2⁶³ to 2⁶³-1          |\r\n| `float`    | 4 bytes   | 3.4e-038 to 3.4e+038   |\r\n| `double`   | 8 bytes   | 1.7e-308 to 1.7e+308   |\r\n| `char`     | 2 bytes   | \'a\', \'B\', \'1\', \'@\'     |\r\n| `boolean`  | 1 bit     | `true`, `false`        |\r\n\r\n---\r\n\r\n#### **2. Non-Primitive Data Types**  \r\nUsed for objects and more complex data:  \r\n- **String**: A sequence of characters (e.g., `\"Hello\"`).  \r\n- **Arrays**: Collection of values (e.g., `int[] arr = {1, 2, 3}`).\r\n- **Classes/Objects**: User-defined types.\r\n- **Interfaces**: Abstractions defining methods.\r\n\r\n---\r\n\r\n**Key Note**: Primitive types are fixed-size, while non-primitive types can grow dynamically.'),
(13, 0, 'variables in java', 'https://www.youtube.com/watch?v=N8LDSryePuc', '### Variables in Java (Short Version)\r\n\r\n- **Local Variable**: Declared inside methods, used within that method.\r\n  ```java\r\n  int x = 10;\r\n  ```\r\n  \r\n- **Instance Variable**: Declared inside a class, but outside methods. Each object has its own copy.\r\n  ```java\r\n  String name;\r\n  ```\r\n\r\n- **Static Variable**: Declared with `static`, shared across all objects of the class.\r\n  ```java\r\n  static int count;\r\n  ```\r\n\r\n**Syntax**:  \r\n```java\r\ndataType variableName = value;\r\n```'),
(14, 0, 'statements in java', 'https://www.youtube.com/watch?v=I5srDu75h_M&t=7s', '### Statements in Java (Short Version)\r\n\r\n- **Expression Statement**: Executes an expression, such as assignments, method calls, or object creation.\r\n- **Declaration Statement**: Declares variables.\r\n- **Control Flow Statements**: Direct the flow of execution (e.g., `if`, `for`, `while`, `switch`).\r\n- **Jump Statements**: Control the flow inside loops (e.g., `break`, `continue`, `return`).\r\n- **Empty Statement**: A statement with no operation (e.g., `;`).'),
(15, 0, 'arithmetic operator in java', 'https://www.youtube.com/watch?v=flWjzwzgybI', '### Arithmetic Operators in Java (Short Version)\r\n\r\n- **`+`**: Addition  \r\n- **`-`**: Subtraction  \r\n- **`*`**: Multiplication  \r\n- **`/`**: Division  \r\n- **`%`**: Modulus (remainder)'),
(16, 0, 'arithmetic operator in java', 'https://www.youtube.com/watch?v=flWjzwzgybI', '### Arithmetic Operators in Java (Short Version)\r\n\r\n- **`+`**: Addition  \r\n- **`-`**: Subtraction  \r\n- **`*`**: Multiplication  \r\n- **`/`**: Division  \r\n- **`%`**: Modulus (remainder)'),
(17, 1, 'statements in c', 'https://www.youtube.com/watch?v=I93JzA_cvPo', '### Statements in C (Short Version)\r\n\r\n- **Expression Statement**: Performs an expression (e.g., variable assignments or function calls).\r\n- **Declaration Statement**: Declares variables.\r\n- **Control Flow Statements**: Direct program flow (e.g., `if`, `else`, `for`, `while`, `switch`).\r\n- **Jump Statements**: Alter the flow (e.g., `break`, `continue`, `return`, `goto`).\r\n- **Empty Statement**: A statement with no operation (e.g., `;`).'),
(18, 2, 'Variable in PHP', 'https://www.youtube.com/watch?v=wuWAK0guilk', 'In PHP, variables are used to store data and are declared with a `$` symbol followed by the variable name. They are dynamically typed, meaning their type is determined by the assigned value. PHP variables are case-sensitive and can hold different data types like strings, integers, arrays, and objects.'),
(19, 2, 'Features of php', 'https://www.youtube.com/watch?v=vSYnrbeUKL0', 'PHP (Hypertext Preprocessor) has the following features:\r\n\r\n1. **Open Source**: Free to use and widely supported.\r\n2. **Server-Side Scripting**: Executes on the server to generate dynamic web pages.\r\n3. **Platform Independent**: Runs on multiple platforms like Windows, Linux, and macOS.\r\n4. **Database Support**: Easily integrates with databases like MySQL, PostgreSQL, and more.\r\n5. **Embedded in HTML**: Can be embedded within HTML for dynamic content.\r\n6. **Easy Integration**: Works seamlessly with web technologies like JavaScript and CSS.\r\n7. **Secure**: Offers features to handle security threats like SQL injection.'),
(20, 3, 'Introduction to PYTHON', 'https://www.youtube.com/watch?v=DInMru2Eq6E', 'Python is a versatile, high-level programming language known for its simplicity and readability. It supports various programming paradigms, including object-oriented, procedural, and functional programming. Python is widely used for web development, data science, AI, automation, and more due to its vast libraries and active community.'),
(21, 3, 'History of python', 'https://www.youtube.com/watch?v=1UzSDMJRh8c', 'Python was created by Guido van Rossum in 1991 and was inspired by the ABC programming language. It was developed to emphasize code readability and simplicity. Over the years, Python has evolved, with major releases like Python 2 in 2000 and Python 3 in 2008, becoming one of the most popular programming languages globally.'),
(22, 3, 'Printing to Console in Python', 'https://www.youtube.com/watch?v=lygaoUnJKF4', 'In Python, the `print()` function is used to display output on the console. It can print strings, variables, and expressions, and supports optional arguments like `sep` for separators and `end` for line endings.'),
(23, 3, 'If & If Else Conditional Statements in Python', 'https://www.youtube.com/watch?v=MMzXz7EDTZM', 'In Python, `if` and `if-else` statements are used for decision-making. The `if` statement executes a block of code if a condition is true. The `if-else` statement adds an alternative block of code to execute if the condition is false. Python uses indentation to define these code blocks.'),
(24, 4, 'Introduction to react js', 'https://www.youtube.com/watch?v=Y6aYx_KKM7A', 'ReactJS is a popular JavaScript library developed by Facebook for building user interfaces, especially for single-page applications. It enables the creation of reusable UI components, making development faster and more efficient. React uses a virtual DOM to optimize rendering and improve performance, and it supports features like hooks and state management to handle dynamic data. React’s component-based architecture makes it highly modular and scalable for complex applications.'),
(25, 5, 'Variable in Cpp', 'https://www.youtube.com/watch?v=fZbSl58orNs', 'In C++, a variable is a container used to store data. It must be declared with a specific data type, such as `int`, `float`, or `char`, followed by the variable name. Variables can hold values of various data types, and their values can be changed during program execution. C++ requires variables to be initialized before use.'),
(26, 5, 'data type in cpp', 'https://www.youtube.com/watch?v=8GJqjFoY7UQ', 'In C++, data types define the type of data a variable can hold. Common types include:\r\n- **int**: Integer values\r\n- **float**: Single-precision decimals\r\n- **double**: Double-precision decimals\r\n- **char**: Single characters\r\n- **bool**: True/false values\r\n- **array**: Collection of elements\r\n- **pointer**: Stores memory addresses\r\n- **struct**: Groups different data types\r\n- **class**: Object-oriented structure\r\n- **enum**: Named integer constants\r\n- **void**: Represents no value.');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expiry_date` varchar(7) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `cardholder_name` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `course_id`, `status`, `card_number`, `expiry_date`, `cvv`, `cardholder_name`, `payment_date`) VALUES
(1, 1, 0, 'success', '12547896', '12/26', '123', 'anisha gaikwad', '2024-11-20 07:56:34'),
(10, 1, 2, 'success', '123654789', '12/28', '321', 'anisha gaikwad', '2024-11-21 09:52:50'),
(11, 3, 0, 'success', '1256347895', '11/56', '369', 'samruddhi gaikwad', '2024-11-26 03:16:13'),
(12, 4, 0, 'success', '123654799', '12/58', '258', 'shrisha', '2024-12-05 19:24:33'),
(13, 5, 3, 'success', '147852693', '01/56', '456', 'laukik deshmukh', '2024-12-05 19:31:57'),
(14, 5, 4, 'success', '14785296', '04/26', '456', 'laukik deshmukh', '2024-12-05 19:32:45'),
(15, 8, 4, 'success', '1254782365', '02/50', '500', 'shivtej patil', '2024-12-05 19:36:13'),
(16, 9, 2, 'success', '25874136', '03/40', '654', 'rutuja', '2024-12-05 19:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Anisha Gaikwad', 'anisha@gmail.com', '$2y$10$UvF4KbO6xYUek2bCNjA8Ce/Yk2NYDq/yDomOI/XrxQyCqm1fF3EF2', '2024-11-18 13:18:44'),
(2, 'vedant gaikwad', 'vedant@gmail.com', '$2y$10$R3Bv03Mv7apLBQGGht.Mt.dZECANbgR4mo/W6jJHZajypzxVIytUe', '2024-11-20 17:14:23'),
(3, 'samruddhi gaikwad', 'sam@gmail.com', '$2y$10$B0MmwoM2l2apMILW9stO/OJDc7PJWj9yTuAol0kuZqiLEIVoUCxDe', '2024-11-25 21:14:14'),
(4, 'SHRISHA NIVANGUNE', 'shrisha@gamil.com', '$2y$10$ng5btTh6KG2PgQAL2mbAXeIiQnIbDi8DzRFhq84MDxRf6Peknxnba', '2024-12-05 13:23:41'),
(5, 'Laukik Deshmukh', 'laukik@gmail.com', '$2y$10$MQUycl9p5QsfBwKaHd/TZ.zeeFGP87HQ/nHsF23ASFKGzWykTfsfG', '2024-12-05 13:30:51'),
(6, 'shreya dhumal', 'shreya@gmail.com', '$2y$10$lZLYPyoyftROgx0OofeVBOeuIJy03Y5D/MWSMiLbY7Lh85Xi9UTJ2', '2024-12-05 13:33:56'),
(8, 'shivtej patil', 'shivtej@gmail.com', '$2y$10$vQ9F5CQOfURVjrmXMNIuyuueq5dlzfJiZvTjt3mWp2s89jCYFA5ri', '2024-12-05 13:35:03'),
(9, 'rutuja pasalkar', 'rutuja@gmail.com', '$2y$10$0UB.15gX4vHA2Z8GYbGDwOtPuCG6oJ4V716mrTSKrguH7ApV/re7y', '2024-12-05 13:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$QglRhskffqlC1LFreLDK2OPV1ja0ejIGqZG5MBjNPSvyNDHueOpF2', 'admin'),
(2, 'anisha', 'anisha', 'admin'),
(3, 'abc', 'abc', 'admin'),
(4, 'pqr', 'pqr', 'admin'),
(5, 'abcd', 'abcd', 'admin'),
(6, 'bcd', 'bcd', 'admin'),
(7, 'def', 'def', 'admin'),
(8, 'efg', 'efg', 'admin'),
(9, 'ghi', 'ghi', 'admin'),
(10, 'xyz', 'xyz', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_enrollments`
--
ALTER TABLE `course_enrollments`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_enrollments`
--
ALTER TABLE `course_enrollments`
  ADD CONSTRAINT `course_enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
