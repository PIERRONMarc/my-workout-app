import React from 'react';
import './header.scss';

export default class Header extends React.Component {
   
    render() {
        return (
            <header className="header">
                <img src="#" alt="logo"/>
                <h1 className="header__title">My Workout App</h1>
                <nav className="navbar">
                    <ul className="navbar__nav">
                        <li className="navbar__item"><a href="#" className="navbar__link">HOME</a></li>
                        <li className="navbar__item"><a href="#" className="navbar__link">MY PROFILE</a></li>
                        <li className="navbar__item"><a href="#" className="navbar__link">LOG IN</a></li>
                    </ul>
                </nav>
            </header>
        )
    }
}