var items = document.querySelectorAll("#list li"),
            tab = [], index;
            var index= 0;
            console.log(items);
            //console.log(tab);
            //console.log(index);
        // add values to the array
        for(var i = 0; i < items.length; i++){
           tab.push(items[i].innerHTML);
         }
        
        // get selected element index
        for(var i = 0; i < items.length; i++)
        {
            index = i;
            //console.log(index); 
            items[i].onclick = function(){
               var x = items[index].id;
               //console.log(i);
               //console.log("i in for loop"+" "+i+" "+items.length); 
               //index = tab.indexOf(this.innerHTML);
               //console.log(this.innerHTML + " Index = " + index);
               console.log(x);
               console.log('asdasdasdasdasdasdas');

               /// id -> get
               //alert(x);
            };
        }