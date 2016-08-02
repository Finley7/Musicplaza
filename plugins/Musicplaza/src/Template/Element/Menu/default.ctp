<div class="header-up">
    <div class="container">
        <div class="row">
            <div class="col-md-2 panels">
                <h1 class="logo">musicplaza</h1>
            </div>
            <div class="col-md-4 col-md-offset-6 panels">
                <div class="panel panel-header">
                    <div class="panel-body">
                        Welkom op Empire! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam assumenda commodi culpa dolor dolorum ea, est fugit maxime, nihil odit possimus, quam quas sequi tempora tempore veniam vero! Quibusdam, reiciendis.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-default menu-header">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-collapse"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="menu-collapse">
            <ul class="nav navbar-nav">
                <li><?= $this->Html->link(__('Log in'), ['controller' => 'Users', 'action' => 'login']); ?></li>
                <li><?= $this->Html->link(__('Create an account'), ['controller' => 'Users', 'action' => 'add']); ?></li>
            </ul>
        </div>
    </div>
</nav>