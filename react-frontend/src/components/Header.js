import React from 'react'

const Header = () => (
    <div className="mdl-layout mdl-layout--fixed-header">
        <header className="mdl-layout__header">
            <div className="mdl-layout__header-row">
                <span className="mdl-layout-title">Bulletinboard</span>
                <div className="mdl-layout-spacer" />
                <nav className="mdl-navigation mdl-layout--large-screen-only">
                    <a className="mdl-navigation__link" href="#">Login</a>
                </nav>
            </div>
        </header>
        <div className="mdl-layout__drawer">
            <span className="mdl-layout-title">Guestbook</span>
            <nav className="mdl-navigation">
                <a className="mdl-navigation__link" href="#">Login</a>
            </nav>
        </div>
        <main className="mdl-layout__content">
            <div className="page-content">Test</div>
        </main>
    </div>
);

export default Header
