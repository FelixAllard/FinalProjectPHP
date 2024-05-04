import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router, Route, Routes} from 'react-router-dom';
import './index.css';
import AppLogInOut from './AppLogInOut';
import Menu from './components/menu/Menu';
import reportWebVitals from './reportWebVitals';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.js';
import $ from 'jquery';
import Popper from 'popper.js';
import 'bootstrap/dist/js/bootstrap.bundle.min';

ReactDOM.render(
    <React.StrictMode>
        <Router>
            <Routes>
                <Route exact path="/" element={<AppLogInOut />} />
                <Route path="/menu" element={<Menu />} />
            </Routes>
        </Router>
    </React.StrictMode>,
    document.getElementById('root')
);

reportWebVitals();
