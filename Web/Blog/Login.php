<div ng-controller="indexController" style="padding-left:20px;border:solid;width:500px;height:400px;position:relative;left:30px">
    <h2>Admin Login</h2>
    
    <h2 style="color:red"></h2>
    
    <div ng-if="!lg.logged">
        <form>
            <h3>Username</h3> <br/>

            <input name="username" type="text" class="form-control input-sm" ng-model="credentials.username" style="width:300px"/> <br/>

            <h3>Password</h3>

            <input name="password" type="password" class="form-control input-sm" ng-model="credentials.password" style="width:300px" /> <br/>

            <button type='submit' ng-click='login()'>Submit</button>

            {{credentials.username}}
         </form>
    </div>
    
    <div ng-if="lg.logged">
        <h2>You are already logged in!</h2>
        <form name="loginForm" method="post">

            <input type="submit" value="Logout" class="btn btn-secondary" id="loginBtn"/>
            
        </form>
    </div>
</div>