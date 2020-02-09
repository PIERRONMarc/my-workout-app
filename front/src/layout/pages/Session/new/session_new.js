import React from 'react';
import './session_new.scss';
import { format } from 'date-fns';
import DateFnsUtils from '@date-io/date-fns';
import { MuiPickersUtilsProvider, KeyboardDatePicker } from '@material-ui/pickers';
import { createMuiTheme } from "@material-ui/core";
import { ThemeProvider } from "@material-ui/styles";
import CircularProgress from '@material-ui/core/CircularProgress';
import Fab from '@material-ui/core/Fab';
import ArrowForwardIosIcon from '@material-ui/icons/ArrowForwardIos';
import CheckIcon from '@material-ui/icons/Check';

export default class SessionNew extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            date: new Date(),
            loading: false,
            success: false
        };

        this.handleDateChange = this.handleDateChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleDateChange(date) {
        this.setState({
            date: date
        });
    }

    handleSubmit = (e) => {
        e.preventDefault();

        this.setState({
            loading:true
        });

        let date = format(this.state.date, 'MM/dd/yyyy'); //SQL format

        fetch(process.env.REACT_APP_BACKEND_API + 'sessions', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({day: date}) 
        })
        .then(res => res.json())
        .then(data => {
            this.setState({
                loading: false,
                success: true
            });
            if (data.id) {
                this.props.history.push('/sessions/' + data.id);
            } else {
                //request failed
            }
        });
    }
    
    render() {
        
        // styles calendar input
        const materialTheme = createMuiTheme({
            typography: {
                htmlFontSize: 11,
            },
            palette: {
                primary: {
                    main: '#F36E21'
                },
                secondary: {
                    main: '#241E20'
                },
                text: {
                    primary: '#FFFFFF',
                },
            },
            overrides: {
                MuiPickersToolbar: {
                     toolbar: {
                             color: '#241E20'
                     },
                },
                MuiPickersCalendarHeader: {
                    switchHeader: {
                        color: '#241E20'
                    }
                },
                MuiPickersDay: {
                    day: {
                        color: '#241E20',
                    },
                },
                MuiInputBase: {
                    formControl: {
                        backgroundColor: 'rgba(255,255,255,0.1)',
                        padding: '0.3rem 1rem',
                        borderRadius: '0.3rem',
                        color: '#FFFFFF',

                        '&& svg': {
                            color: '#FFFFFF'
                        }
                    }
                }
            }
        });

        const {loading, success} = this.state;

        return (
            <div className="main-content session-new">

                <h2 className="session-new__title">New session</h2>
                <form onSubmit={this.handleSubmit} className="session-new__form">

                    <ThemeProvider theme={materialTheme}>
                        <MuiPickersUtilsProvider utils={DateFnsUtils}>
                            <KeyboardDatePicker
                                margin="normal"
                                id="date-picker-dialog"
                                format="dd/MM/yyyy"
                                value={this.state.date}
                                onChange={this.handleDateChange}
                                KeyboardButtonProps={{
                                    'aria-label': 'change date',
                                }}
                            />
                        </MuiPickersUtilsProvider>
                    </ThemeProvider>

                    <div className="btn__wrapper">
                        <Fab
                            aria-label="save"
                            color="primary"
                            onClick={this.handleSubmit}
                            className="btn"
                        >
                        {success ? <CheckIcon style={{fontSize: 20}} /> : <ArrowForwardIosIcon style={{fontSize: 20}} />}
                        
                        {loading && <CircularProgress size={68} className="btn__loading" />}
                        </Fab>
                    </div>

                </form>
            </div>
        )
    }
}