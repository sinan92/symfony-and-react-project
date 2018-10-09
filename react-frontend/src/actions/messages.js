import * as types from './actionTypes';
import axios from 'axios';

export function fetchMessages() {
    return function (dispatch) {
        axios.get('http://localhost:8000/messages')
            .then((response) => {
                dispatch({type: types.FETCH_MESSAGES, payload: response.data})
            })
            .catch((err) => {
                throw(err)
            })
    }
};

export function fetchMessageById(id) {
    return function (dispatch) {
        axios.get('http://localhost:8000/messages/'+id)
            .then((response) => {
                dispatch({type: types.FETCH_MESSAGE_BY_ID, payload: response.data})
            })
            .catch((err) => {
                throw(err)
            })
    }
};

export function upvoteMessage(id) {
    return function (dispatch) {
        axios.get('http://localhost:8000/messages/upvote/'+id)
            .then((response) => {
                dispatch({type: types.UPVOTE_MESSAGE, payload: response.data, id: fetchMessageById(id)})
            })
            .catch((err) => {
                throw(err);
            })
    }
};

export function downvoteMessage(id) {
    return function (dispatch) {
        axios.get('http://localhost:8000/messages/downvote/'+id)
            .then((response) => {
                dispatch({type: types.DOWNVOTE_MESSAGE, payload: response.data, id: fetchMessageById(id)})
            })
            .catch((err) => {
                throw(err);
            })
    }
};