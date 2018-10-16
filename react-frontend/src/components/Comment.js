import React from 'react';
import {Link} from 'react-router';
import { connect } from 'react-redux';

const Comment = (props) => {
        return (
          <div>
              {props.commentModel && props.userModel ? (
                <li className="mdl-list__item mdl-list__item--three-line">
                <span className="mdl-list__item-primary-content">
                <i className="material-icons mdl-list__item-avatar">
                    {props.userModel.userImage}
                </i>
                <span>
                    {props.userModel.userName}
                </span>
                <span class="mdl-list__item-text-body">
                    {props.commentModel.content}
                </span>
                </span>
                <span className="mdl-list__item-secondary-content">
                <div className="comment-date">
                    {props.commentModel.date}
                </div>
                </span>
            </li>
              ) : null}
          </div>
        )
}

export default connect()(Comment);