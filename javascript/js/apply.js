
function TabViewer(){
	this.tabs = new Array('');
	this.currIndex=0;
}
function AddTab(btnID){
	this.tabs.push(document.getElementById(btnID));
}
function bringTruck(ele){
	//var box= ele.id;
	//$("#"+box).transition({ translate:[60] });
	for(var i=0;i<this.tabs.length;i++){	
		if(this.tabs[i] == ele){
			if(i == this.currIndex) return;
			this.prevIndex = this.currIndex;
			this.currIndex = i;
			//this.tabs[i].className = 'tabButton selected';
			//this.views[i].className = 'displayArea show';
		}
		else{
			//this.tabs[i].className = 'tabButton unselected';
			//this.views[i].className = 'displayArea hide';
		}
	}
	
	this.tabs[this.prevIndex].className = '';
	this.tabs[this.currIndex].className = 'active';
	
	
	$("#"+this.tabs[this.currIndex].id+"-car").transition({x:125},500, 'snap');
	$("#"+this.tabs[this.prevIndex].id+"-car").transition({x:0},500, 'snap');
	$("#"+this.tabs[this.prevIndex].id).transition({x:0},700, 'snap');
	$("#"+this.tabs[this.currIndex].id).transition({x:60},700, 'linear');
	
}
TabViewer.prototype.AddTab = AddTab;
TabViewer.prototype.bringTruck = bringTruck;
tabView = new TabViewer();

