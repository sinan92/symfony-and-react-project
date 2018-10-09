import React from 'react'
import Header from './Header'
import MessageCard from './MessageCard'

const App = () => (
  <div>
    <Header />
    <MessageCard
        id={25}
        content={" Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut convallis at arcu eget fringilla." +
            "Aliquam consectetur mi quam. Suspendisse potenti. Nunc et augue sit amet diam lobortis. Nulla eget " +
            "vestibulum magna. Duis sagittis aliquet velit. Proin sit amet justo nunc. Lorem ipsum dolor sit amet," +
            "consectetur adipiscing elit.\n" +
            "\n" +
            "Sed ac sem molestie, pharetra nibh vel, condimentum turpis. Integer sit amet nunc sed enim blandit" +
            "dapibus quis a tortor. Proin fermentum ultrices ex ut mollis. Duis a nunc finibus dui interdum" +
            " vestibulum. Ut mattis volutpat volutpat. Duis sit amet mattis arcu. Phasellus et gravida tellus. "}
        category={"Zinvol"}
        date={"16/09/1997"}
        upvotes={25}
        downvotes={3}
    />
    <MessageCard
        id={2}
        content={" Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut convallis at arcu eget fringilla." +
            "Aliquam consectetur mi quam. Suspendisse potenti. Nunc et augue sit amet diam lobortis. Nulla eget " +
            "vestibulum magna. Duis sagittis aliquet velit. Proin sit amet justo nunc. Lorem ipsum dolor sit amet," +
            "consectetur adipiscing elit.\n" +
            "\n" +
            "Sed ac sem molestie, pharetra nibh vel, condimentum turpis. Integer sit amet nunc sed enim blandit" +
            "dapibus quis a tortor. Proin fermentum ultrices ex ut mollis. Duis a nunc finibus dui interdum" +
            " vestibulum. Ut mattis volutpat volutpat. Duis sit amet mattis arcu. Phasellus et gravida tellus. "}
        category={"Zinvol"}
        date={"25/10/2018"}
        upvotes={300}
        downvotes={30}
    />
      <MessageCard
          id={100}
          content={" Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut convallis at arcu eget fringilla." +
          "Aliquam consectetur mi quam. Suspendisse potenti. Nunc et augue sit amet diam lobortis. Nulla eget " +
          "vestibulum magna. Duis sagittis aliquet velit. Proin sit amet justo nunc. Lorem ipsum dolor sit amet," +
          "consectetur adipiscing elit.\n" +
          "\n" +
          "Sed ac sem molestie, pharetra nibh vel, condimentum turpis. Integer sit amet nunc sed enim blandit" +
          "dapibus quis a tortor. Proin fermentum ultrices ex ut mollis. Duis a nunc finibus dui interdum" +
          " vestibulum. Ut mattis volutpat volutpat. Duis sit amet mattis arcu. Phasellus et gravida tellus. "}
          category={"Onzin"}
          date={"11/09/2001"}
          upvotes={3}
          downvotes={500}
      />
  </div>
);

export default App
