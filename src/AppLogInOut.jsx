import React, { useEffect, useState } from 'react';
import axios from "axios";
import { useNavigate } from 'react-router-dom'; // Import useHistory
import './App.css';
import Login from './components/login/Login';

function AppLogInOut() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const history = useNavigate(); // Initialize useHistory hook

  useEffect(() => {
    if (sessionStorage.getItem('user') !== null)
      handleLoginSuccess();
  }, []);

  const handleLoginSuccess = () => {
    document.title = JSON.parse(sessionStorage.getItem('user')).name;
    setIsLoggedIn(true);
    history.push('/menu'); // Redirect to the menu page
  };

  const handleLogout = () => {
    sessionStorage.clear();
    setIsLoggedIn(false);
    axios.post("http://localhost:8000/api/ext/logoutUser")
        .then((response) => {
          if (response.status === 200) {
            sessionStorage.clear();
            setIsLoggedIn(false);
            console.log(response.data);
          }
        })
        .catch(function (error) {
          console.log(error);
        });
  };

  return (
      <>
        {!isLoggedIn?
            <div>
              <div>
                <Login onLoginSuccess={handleLoginSuccess} />
              </div>
              <div>
                Create Registration tag
              </div>
            </div>
            :
            <div>
              Show menu<br></br>
              <button
              onClick={handleLogout}
              >
              Log out
            </button>
              <div style={{ margin: "20px" }}>
                Your Shopping Cart implementation:
              </div>
            </div>
        }
      </>
  );
}

export default AppLogInOut;
