<div id="homeView" ng-controller="indexController">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create a new Post!</h4>
      </div>
      <div class="modal-body">
        <div style="padding-left:10px">
            <div class="panel panel-primary" style="width: 750px">
                <div class="panel-heading" style="font-size:16px">Topic:</div>
                <div class="panel-body">
                    <input id="createTitle" type="text" class="form-control input-sm" />
                </div>
            </div>

            <h3>Details</h3>

            <container id="editor"></container>
            <br />

            <button onclick="addPost()" class="btn btn-secondary" id="submitBtn">Submit</button>
        </div>
      </div>
    </div>