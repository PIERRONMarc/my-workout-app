import React from 'react';
import { Link } from 'react-router-dom';
import './session.css';

export default class Session extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            date: ''
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleChange(event) {
        this.setState({
            date: event.target.value
        });
    }

    handleSubmit(event) {
        event.preventDefault();
        fetch('http://localhost/api/sessions', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({day: this.state.date}) 
        })
        .then(res => res.json())
        .then((data) => {
            console.log(data);
        })
        .catch(console.log);
        event.preventDefault();
    }
    
    //test api
    componentDidMount() {
        fetch('http://localhost/api/exercices')
        .then(res => res.json())
        .then((data) => {
            console.log(data);
        })
        .catch(console.log);
    }

    render() {
        return (
            <div className="content">
                <h1 className="text-center text-white">Session page</h1>
                <form onSubmit={this.handleSubmit}>
                    <input type="text" value={this.state.value} onChange={this.handleChange} />
                    <input type="submit" value="Envoyer" />
                </form>
            </div>
        )
    }
}