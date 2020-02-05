import React from '../../../node_modules/react';
import Home from '../pages/Home/Home.js'
import SessionIndex from '../pages/Session/index/session_index.js'
import SessionNew from '../pages/Session/new/session_new.js'
import SessionShow from '../pages/Session/show/session_show.js'
import SessionLast from '../pages/Session/last/session_last.js'
// import logo from '../../assets/logo.svg';
import './App.css';
import {
  BrowserRouter as Router,
  Switch,
  Route,
  // Link
} from "react-router-dom";

export default function App() {
  return (
    <Router>
      <div className="App">
        <Switch>
          <Route path="/" component={Home} exact/>
          <Route path="/sessions/new" component={SessionNew} exact/>
          <Route path="/sessions" component={SessionIndex} exact/>
          <Route path="/sessions/last" component={SessionLast} exact/>
          <Route path="/sessions/:id" component={SessionShow} exact/>
        </Switch>
      </div>
    </Router>
    
  );
}