import React from 'react'
import PropTypes from "prop-types";

const MessageCard = (props) => {
    return (

        <div class="demo-card-wide mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h3 class="mdl-card__title-text">Message nr. {props.id}</h3>
            </div>
            <div class="mdl-card__supporting-text">
                {props.content}
            </div>
            <span className="mdl-chip mdl-chip--contact">
                <span className="mdl-chip__contact mdl-color--teal mdl-color-text--white">{props.upvotes}</span>
                <span className="mdl-chip__text">Upvote</span>
            </span>
            <span className="mdl-chip mdl-chip--contact">
                <span className="mdl-chip__contact mdl-color--teal mdl-color-text--white">{props.downvotes}</span>
                <span className="mdl-chip__text">Downvote</span>
            </span>
            <div class="mdl-card__actions mdl-card--border">
               <div class="">
                   Posted on {props.date}
                   <br/>
               </div>
               <div className="mdl-card__subtitle-text">
                    Category: {props.category}
               </div>
            </div>
        </div>
    )
};

MessageCard.PropTypes = {
    id: PropTypes.number,
    content: PropTypes.string,
    category: PropTypes.string,
    date: PropTypes.string,
    upvotes: PropTypes.number,
    downvotes: PropTypes.number
};

export default MessageCard;