import React from 'react'
import Footer from './Footer'
import Header from './Header'
import VisibleTodoList from '../containers/VisibleTodoList'

const App = () => (
  <div>
    <Header />
    <VisibleTodoList />
    <Footer />
  </div>
)

export default App
