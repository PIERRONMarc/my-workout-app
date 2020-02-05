import React from 'react';
import './session_index.css';
import Button from '@material-ui/core/Button';
import { Link } from 'react-router-dom';

export default class SessionIndex extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            sessions: []
        }
    }

    componentDidMount() {
        fetch(process.env.REACT_APP_BACKEND_API + 'sessions', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then((data) => {
            this.setState({
                sessions: data
            })
        })
        .catch(console.log);
    }

    render() {
        const sessions = this.state.sessions;

        return(
            <div className="content">
                <h1>AllSession</h1>
                {sessions.map((session) => 
                    <div key={session.id}>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>DAY</th>
                                    <th>ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{session.id}</td>
                                    <td>{session.day}</td>
                                    <td>
                                        <Link to={"sessions/" + session.id}><Button variant="contained">see</Button></Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                )}
            </div>
        )
    }
}