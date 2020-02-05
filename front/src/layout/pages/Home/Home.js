import React from 'react';
import { Link } from 'react-router-dom';
import './home.css';

export default class Home extends React.Component {
    render() {
        return (
            <section>
                <div className="firstHalf">
                    <h1>My workout APP</h1>
                    <div className="d-flex justify-content-around">
                        <Link to="/sessions/new" className="btn btn-primary">New session</Link>
                        <Link to="/sessions" className="btn btn-primary">All session</Link>
                        <Link to="/sessions/last" className="btn btn-primary">Last session</Link>
                    </div>
                </div>
            </section>
        )
    }
}