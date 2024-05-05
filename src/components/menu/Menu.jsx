import React, { useState, useEffect } from 'react';
import {useNavigate} from "react-router-dom";
import axios from "axios";
import Login from "../login/Login";

import AppLogInOut from "../../AppLogInOut";

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;
function ItemList() {
    const [items, setItems] = useState([]);
    const [cartItems, setCartItems] = useState([]);
    const [searchQuery, setSearchQuery] = useState('');
    const [username, setUsername] = useState('unidentified');
    const [total, setTotal] = useState(0);
    const [isLoggedIn, setIsLoggedIn] = useState(false);
    const history = useNavigate(); // Initialize useHistory hook

    useEffect(() => {
        fetchItems();

        if (sessionStorage.getItem('user') !== null) {
            handleLoginSuccess();
        }
    }, []);

    useEffect(() => {
        if (isLoggedIn) {
            fetchCart();
        }
    }, [isLoggedIn]);

    useEffect(() => {
        if (cartItems.length > 0) {
            updateShoppingCart();
        }
    }, [cartItems]);

    const handleLoginSuccess = () => {
        const user = JSON.parse(sessionStorage.getItem('user'));
        document.title = user.name;
        setIsLoggedIn(true);
        setUsername(user.name);
    };

    const handleLogout = () => {
        setIsLoggedIn(false);
        setCartItems([]);
        setTotal(0);
        axios.post("http://localhost:8000/api/ext/logoutUser")
            .then((response) => {
                if (response.status === 200) {
                    console.log(response.data);
                }
            })
            .catch(function (error) {
                console.log(error);
            });
        sessionStorage.clear();
    };

    const fetchItems = () => {
        fetch('http://localhost:8000/api/items/getall')
            .then(response => response.json())
            .then(data => setItems(data))
            .catch(error => console.error('Error fetching items:', error));
    };

    const handleSearch = (e) => {
        e.preventDefault();
        fetch(`http://localhost:8000/api/items/search?query=${searchQuery}`)
            .then(response => response.json())
            .then(data => setItems(data))
            .catch(error => console.error('Error searching items:', error));
    };

    const fetchCart = () => {

        fetch(`http://localhost:8000/api/user/shoppingcart?username=${JSON.parse(sessionStorage.getItem('user')).name}`)
            .then(response => response.json())
            .then(data => {
                const cartItemsArray = Array.isArray(data) ? data : [data];
                setCartItems(cartItemsArray);
            })
            .catch(error => console.error('Error fetching cart:', error));
    };


    const addToCart = (itemToAdd) => {
        const existingItemIndex = cartItems.findIndex(item => item.id === itemToAdd.id);
        if (existingItemIndex !== -1) {
            const updatedCartItems = [...cartItems];
            updatedCartItems[existingItemIndex].quantity += 1;
            setCartItems(updatedCartItems);
        } else {
            setCartItems(prevCartItems => [...prevCartItems, { ...itemToAdd, quantity: 1 }]);
        }
    };

    const decreaseQuantity = (itemToRemove) => {
        const updatedCartItems = [...cartItems];
        const index = updatedCartItems.findIndex(item => item.id === itemToRemove.id);

        if (index !== -1) {
            updatedCartItems[index].quantity -= 1;
            if (updatedCartItems[index].quantity === 0) {
                updatedCartItems.splice(index, 1);
            }
            setCartItems(updatedCartItems);
        }
    };

    const calculateTotalPrice = () => {
        let totalPrice = 0;
        cartItems.forEach(item => {
            totalPrice += item.price * item.quantity;
        });
        setTotal(totalPrice);
    };

    const updateShoppingCart = async () => {
        try {
            await axios.put('http://localhost:8000/api/user/shoppingcart/update', {
                username: username,
                items: cartItems
            });
            console.log('Shopping cart updated successfully');
        } catch (error) {
            console.error('Error updating shopping cart:', error);
        }
    };



    return (
        <div>
            <nav className="navbar bg-body-tertiary">
                <div className="container-fluid navbar-brand bg-dark">
                    <a className="">Walmart Groceries</a>
                    <form className="d-flex" onSubmit={handleSearch}>
                        <input
                            className="form-control me-2"
                            type="search"
                            placeholder="Search"
                            aria-label="Search"
                            value={searchQuery}
                            onChange={(e) => setSearchQuery(e.target.value)}
                        />
                        <button className="btn btn-outline-success" type="submit">
                            Search
                        </button>


                        <button className="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">View Cart
                        </button>


                    </form>
                    <div className="offcanvas offcanvas-end" tabIndex="-1" id="offcanvasRight"
                         aria-labelledby="offcanvasRightLabel">
                        <div className="offcanvas-header">
                            <h5 className="offcanvas-title" id="offcanvasRightLabel">Welcome {username}!</h5>
                            <button type="button" className="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                        </div>
                        <div className="offcanvas-body">
                            {isLoggedIn ? (
                                <div>
                                    <button
                                        onClick={handleLogout}
                                    >
                                        Log out
                                    </button>
                                    <form>
                                        <ol className="list-group list-group-numbered">

                                            <li className="list-group-item d-flex justify-content-between align-items-start bg-primary bg-gradient">
                                                <div className="ms-2 me-auto">
                                                    <div className="fw-bold">Item</div>
                                                    Price
                                                </div>
                                                <span
                                                    className="badge text-bg-primary rounded-pill">Quantity</span>
                                            </li>
                                            {cartItems.map(item => (
                                                <li className="list-group-item d-flex justify-content-between align-items-start"
                                                    key={item.id}>
                                                    <div className="ms-2 me-auto">
                                                        <div className="fw-bold">{item.name}</div>
                                                        $ {item.price}
                                                    </div>
                                                    <div>
                                                        <button className="btn btn-sm btn-danger me-2"
                                                                onClick={() => decreaseQuantity(item)}>Remove
                                                        </button>
                                                        <span
                                                            className="badge text-bg-primary rounded-pill">{item.quantity}</span>
                                                    </div>
                                                </li>

                                            ))}
                                            <li className="list-group-item d-flex justify-content-between align-items-start bg-primary bg-gradient">
                                                <div className="ms-2 me-auto">
                                                    <div className="fw-bold">Total</div>
                                                    ${total}
                                                </div>
                                            </li>
                                        </ol>
                                    </form>
                                </div>

                            ) : (
                                <Login onLoginSuccess={handleLoginSuccess}/>
                            )}
                        </div>
                    </div>
                </div>
            </nav>
            <div style={{display: "flex", flexWrap: "wrap"}}>
                {items.map(item => (
                    <div className="card" style={{width: "18rem", margin: "0.5rem"}} key={item.id}>
                        <div className="card-body">
                            <h5 className="card-title">{item.name}</h5>
                            <h6 className="card-subtitle mb-2 text-body-secondary">Item quantity: {item.quantity}</h6>
                            <p className="card-text">{item.description}</p>
                            {isLoggedIn && ( // Show button only if user is logged in
                                <button className="btn btn-primary" onClick={() => addToCart(item)}>
                                    Add to Cart
                                </button>
                            )}
                        </div>
                    </div>
                ))}
            </div>

        </div>
    );
}

export default ItemList;
