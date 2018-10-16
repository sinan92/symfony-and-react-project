import React from 'react';
import {Link} from 'react-router';
import { connect } from 'react-redux';

class Home extends React.Component {
    render(){
        return (
            <div>
                This is the comment homepage test.sdfsaf
            </div>
        );
    }
}

export default connect()(Home);