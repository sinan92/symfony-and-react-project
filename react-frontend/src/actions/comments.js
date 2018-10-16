import * as types from './actionTypes';
import axios from 'axios';

export function postComment(messageId, comment) {
    return function (dispatch) {
        axios.post('http://localhost:8000/messages/comment/post/', {messageId, comment})
            .then((response) => {
                dispatch({type: types.POST_COMMENT_BY_MESSAGE_ID, payload: response.data})
            })
            .catch((err) => {
                throw(err)
            })
    }
  
}

export function getCommentsByMessageId(messageId) {
    return function (dispatch) {
        axios.get('http://localhost:8000/comments/'+ messageId)
            .then((response) => {
                dispatch({type: types.FETCH_COMMENT_BY_ID, payload: response.data})
            })
            .catch((err) => {
                throw(err)
            })
    }
}