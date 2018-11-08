import React from 'react';
import { connect } from 'react-redux';
import Message from "./Message";
import Comment from "./Comment";
import WriteComment from "./WriteComment";
import {bindActionCreators} from "redux";
import * as messages from "../actions/messages";
import CardWrapper from '../wrappers/CardWrapper'
import Search from "./Search";
import Category from "./Category";

class Home extends React.Component {
    constructor(props){
        super(props);
        this.props.actions.fetchMessages();
        this.props.actions.fetchCategories();
        this.state = {
            comment: '',
        }
    }

    searchChange(event){
        this.props.actions.filterMessagesByContent(event.target.value, this.props.selectedCategory);
    }

    selectCategory(event){
        this.props.actions.selectCategory(event.target.value);
        this.props.actions.filterMessagesByContent(this.props.search, event.target.value);
    }

    changeComment = (event) => {
        this.setState({
            comment: event.target.value
        })
    }

    addComment = (event) => {
        let comment = this.state.comment;
        let id = event.target.value;
        this.props.actions.postComment(id, comment);
        this.props.actions.fetchMessages();
    }

    upvoteClick = (id) => {
        if(this.props.loggedIn){
            this.props.actions.upvoteMessage(id)
        }
    };

    downvoteClick = (id) => {
        if(this.props.loggedIn) {
            this.props.actions.downvoteMessage(id)
        }
    };

    render(){
        const {messages} = this.props;

        let categories = this.props.categories.map((category, index) => <Category key={index} title={category.category}/>);

        return (
            <div>
                <CardWrapper>
                    <Search searchChange={this.searchChange.bind(this)} selectCategory={this.selectCategory.bind(this)} categories={categories} />
                </CardWrapper>
                {messages.map((message, index) =>
                    <CardWrapper key={index}>
                        <Message id={message.id} content={message.content} upvoteClick={this.upvoteClick} downvoteClick={this.downvoteClick} upvotes={message.upVotes} downvotes={message.downVotes} date={message.date} category={message.category}/>

                        {message.comments.map((comment, index) =>
                        <Comment key={index} username={"Anon"} content={comment.content} />
                        )}

                        <WriteComment id={message.id} addComment={this.addComment.bind()} changeComment={this.changeComment} />
                    </CardWrapper>
                )}
            </div>
        );

    }
}
export default connect(store => ({
        messagesAll: store.messages.messages,
        messages: store.messages.messageSearchResults,
        message: store.messages.message,
        categories: store.messages.categories,
        selectedCategory: store.messages.selectedCategory,
        search: store.messages.search,
        loggedIn: store.user.loggedIn
    }),
    (dispatch) => ({
        actions: bindActionCreators({...messages}, dispatch)
    })
)(Home);