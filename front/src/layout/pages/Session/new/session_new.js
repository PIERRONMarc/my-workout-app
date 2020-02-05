import { format } from 'date-fns';
import React from 'react';
// import { Link } from 'react-router-dom';
import './session_new.css';
import DateFnsUtils from '@date-io/date-fns';
import { MuiPickersUtilsProvider, KeyboardDatePicker } from '@material-ui/pickers';

export default class SessionNew extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            date: new Date()
        };

        this.handleDateChange = this.handleDateChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleDateChange(date) {
        date = format(date, 'dd/MM/yyyy');
        this.setState({
            date: date
        });
    }

    handleSubmit = (e) => {
        e.preventDefault();
        fetch(process.env.REACT_APP_BACKEND_API + 'sessions', {
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
        .catch();
    }
    
    render() {
        return (
            <div className="content">
                <h1 className="text-center text-white">Session page</h1>
                <form onSubmit={this.handleSubmit}>
                    <MuiPickersUtilsProvider utils={DateFnsUtils}>
                        <KeyboardDatePicker
                            margin="normal"
                            id="date-picker-dialog"
                            label="Date"
                            format="dd/MM/yyyy"
                            value={this.state.date}
                            onChange={this.handleDateChange}
                            KeyboardButtonProps={{
                                'aria-label': 'change date',
                            }}
                        />
                    </MuiPickersUtilsProvider>
                    <input type="submit" value="Envoyer" />
                </form>
            </div>
        )
    }
}