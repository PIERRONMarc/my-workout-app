import React from 'react';

class SessionShow extends React.Component {
    constructor(props) {
        super(props);
        
        this.state = {
            session: {},
            weight: 0,
            reps: 0,
            exerciceId: 0,
            exercicesList: [],
            isLoading: true
        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleExerciceChange = this.handleExerciceChange.bind(this);
        this.handleRepsChange = this.handleRepsChange.bind(this);
        this.handleWeightChange = this.handleWeightChange.bind(this);
        this.handleSetChange = this.handleSetChange.bind(this);
    }

    componentDidMount() {
        this.setState({
            isLoading: true
        })

        const id = this.props.match.params.id;
        fetch(process.env.REACT_APP_BACKEND_API + "sessions/" + id, {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            this.setState({
                session: data,
                isLoading: false
            })
        })
        .catch();
        
        fetch(process.env.REACT_APP_BACKEND_API + "exercices", {
            method: "GET",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            }
        })
        .then(res => res.json())
        .then(data => {
            this.setState({
                exercicesList: data,
                exerciceId: data[0].id
            })
        });
        
    }

    handleSubmit(event) {
        event.preventDefault();

        let sets = [];
        for (let i = 0; i < parseInt(this.state.reps); i++) {
            sets.push({
                weight: parseFloat(this.state.weight),
                succeed: false
            });
        }

        let exerciceSession = {
            exercice: "/api/exercices/" + this.state.exerciceId,
            session: "/api/sessions/" + this.state.session.id,
            sets: sets
        };

        fetch(process.env.REACT_APP_BACKEND_API + "exercice_sessions", {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify(exerciceSession)
        })
        .then(res => res.json())
        .then(data => {
            let session = this.state.session;
            session.exerciceSessions.push(data);
            
            this.setState({
                session: session
            });
        })
        
    }

    handleExerciceChange(event) {
        this.setState({exerciceId: event.target.value});
    }

    handleRepsChange(event) {
        this.setState({reps: event.target.value});
    }

    handleWeightChange(event) {
        this.setState({weight: event.target.value});
    }

    handleSetChange(event) {
        let set = event.target;
        fetch(process.env.REACT_APP_BACKEND_API + "sets/" + set.id, {
            method: "PUT",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                succeed: set.checked
            })
        });
    }

    render() {

        const { session, exercicesList, isLoading } = this.state;

        return(
            <div className="content">
                <h1>Session Show</h1>
                <ul>
                    <li>{session.id}</li>
                    <li>{session.day}</li>
                </ul>
                {isLoading === true ?
                    <p>Chargement</p>
                    :
                    session.exerciceSessions.map(pivot => 
                        <ul key={pivot.id} style={{backgroundColor:"white",marginBottom: "15px", color: "black"}}>
                            <li>{pivot.exercice.name}</li>
                            <li>
                                <ul>
                                    { pivot.sets.map(set => 
                                        <li key={set.id}>{set.weight} : <input type="checkbox" id={set.id} defaultChecked={set.succeed} onChange={this.handleSetChange}/></li>
                                    )}
                                </ul>
                            </li>
                        </ul>
                    )
                }
                <form onSubmit={this.handleSubmit}>
                    <select value={this.state.value} onChange={this.handleExerciceChange}>
                        {exercicesList.map(exercice => 
                            <option value={exercice.id} key={exercice.id}> {exercice.name} </option>
                        )}
                    </select>
                    <input type="number" value={this.state.value} onChange={this.handleRepsChange}/>
                    <input type="number" value={this.state.value} onChange={this.handleWeightChange}/>
                    <input type="submit" value="Submit"/>
                </form>
            </div>
        )
    }
}

export default SessionShow;