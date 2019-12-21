import React from '../../../node_modules/react';
import Home from '../pages/Home/Home.js'
import Session from '../pages/Session/Session.js'
import logo from '../../assets/logo.svg';
import './App.css';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

function App() {
  return (
    <Router>
      <div className="App">
        <Switch>
          <Route path="/" component={Home} exact/>
          <Route path="/session" component={Session} exact/>
        </Switch>
      </div>
    </Router>
    
  );
}

export default App;
