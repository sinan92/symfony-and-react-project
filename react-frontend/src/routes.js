import React from 'react';
import App from "./components/App";
import CommentPage from "./components/CommentPage";
import HomePage from "./components/HomePage";

export default (
    <Route path="/" component={App}>
        <IndexRoute component={HomePage} />
        <Route path="comment" component={CommentPage} />
    </Route>
)