import React from 'react';
import { Link } from 'react-router-dom';
import './home.scss';

export default class Home extends React.Component {
    render() {
        return (
            <section className="main-content">
                <div className="d-flex justify-content-around">
                    <Link to="/sessions/new" className="btn btn-primary">New session</Link>
                    <Link to="/sessions" className="btn btn-primary">All session</Link>
                    <Link to="/sessions/last" className="btn btn-primary">Last session</Link>
                </div>
            </section>
        )
    }
}