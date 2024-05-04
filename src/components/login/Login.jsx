import React, { useState } from "react";
import axios from "axios";//npm i axios

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

function Login({ onLoginSuccess }) {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");

  const handleSubmit = (event) => {
    
    event.preventDefault();
    // TODO: Implement API call to authenticate user
    axios.get("http://localhost:8000/api/sanctum/csrf-cookie")
      .then(async (x) => {
        console.log(x.data);
        axios.post(`http://localhost:8000/api/ext/loginUser`, { username, password })
        .then((response) => {
          if (response.status === 200) {
              console.log( response.data);
              let userString = JSON.stringify(response.data[0]);
              sessionStorage.setItem("user", userString);              
              onLoginSuccess(); // Call onLoginSuccess when login is successful
          }else if (response.status === 204) {
            alert(`Invalid credentials`);
          }
        })
      })
      .catch(function (error) {
        // handle error
        console.log(error);
      });
  };

  return (
    <div className="center">
      <h1>Login</h1>
      <form onSubmit={handleSubmit}>
        <div className="inputbox">
          <input
            type="text"
            value={username}
            placeholder="username"
            onChange={(event) => setUsername(event.target.value)}
          />
        </div>
        <div className="inputbox">
          <input
            type="password"
            value={password}
            placeholder="password"
            onChange={(event) => setPassword(event.target.value)}
          />
        </div>
        <button className="submitButton" type="submit">Login</button>
      </form>
    </div>
  );
}

export default Login;
