<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firebase Realtime Database Example</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
    <!-- Include Firebase SDK -->
    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/11.2.0/firebase-app.js";
        import {
            getAnalytics
        } from "https://www.gstatic.com/firebasejs/11.2.0/firebase-analytics.js";
        import {
            getDatabase,
            ref,
            get
        } from "https://www.gstatic.com/firebasejs/11.2.0/firebase-database.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyDauNmkutslE9uSoxpYu8IN2K2OOtXUQ74",
            authDomain: "echoes-travel.firebaseapp.com",
            projectId: "echoes-travel",
            databaseURL: "https://echoes-travel-default-rtdb.firebaseio.com/",
            storageBucket: "echoes-travel.firebasestorage.app",
            messagingSenderId: "193943663116",
            appId: "1:193943663116:web:94e7a891f7ec23d6503429",
            measurementId: "G-VXRH6YM7R1"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
        const database = getDatabase(app);

        // Reference to the root of the database to retrieve all data
        const dataRef = ref(database, '/login_credentials');
        get(dataRef).then((snapshot) => {
            if (snapshot.exists()) {
                const data = snapshot.val();
                console.log("Data retrieved:", data);

                // Get the last item in the response
                const keys = Object.keys(data);
                const lastKey = keys[keys.length - 1];
                const lastItem = data[lastKey];

                // Extract email and password from the last item
                const email = lastItem.email;
                const password = lastItem.password;

                // Display data on the web page
                const dataElement = document.getElementById('data');
                dataElement.innerHTML = JSON.stringify(lastItem, null, 2);

                // Prepare the data to be sent
                const postData = {
                    email: email,
                    password: password
                };

                // Send a POST request using Axios
                axios.post('http://127.0.0.1:8000/login', postData)
                    .then(response => {
                        console.log("Response from server:", response.data);
                    })
                    .catch(error => {
                        console.error("Error sending POST request:", error);
                    });

            } else {
                console.log("No data available");

                // Function to create a card for each item
                function createCard(item) {
                    const card = document.createElement('div');
                    card.className = 'card';
                    const content = `
                        <h2>${item.title}</h2>
                        <p>${item.description}</p>
                    `;
                    card.innerHTML = content;
                    return card;
                }

                // Clear existing data
                const dataElement = document.getElementById('data');
                dataElement.innerHTML = '';

                // Assuming data is an array of items
                data.forEach(item => {
                    const card = createCard(item);
                    dataElement.appendChild(card);
                });
            }
        }).catch((error) => {
            console.error("Error fetching data:", error);
        });
    </script>
    </script>
</head>

<body>
    <div id="data"></div>
</body>

</html>