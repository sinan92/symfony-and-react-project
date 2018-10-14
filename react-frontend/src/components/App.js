import React from 'react'
import Header from './Header'
import MessageCard from './MessageCard'
import { Route } from 'react-router';
import Layout from './Layout';
import Home from './Home';
import Comment from './Comment';

const App = () => (
    <Layout>
      <Route exact path='/' component={Home} />
      <Route path='/comment' component={Comment} />
    </Layout>
);
export default App;
  