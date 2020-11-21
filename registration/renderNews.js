export async function generateNewsFeed(e) {
    
    e.preventDefault();
    
    const $root = $('#newsFeed')
    $root.empty();

    // LOCAL RUN
    //const myKey = "480cae414ceb43cbab94d9ab001bd7ec"

    // SERVER RUN
    const myKey = "c97e329f04a9821fe41a8f8bde77b7e6"

    //let ticker = $(`p[class="control"][name="stockType"]`).text();
    let ticker = document.getElementById('ticker').value;
    console.log(ticker)

    const feed = await axios({

        method: 'get',
        //url: `http://api.datanews.io/v1/headlines`,
        //headers: {
        //    Authorization: `${myKey}`,
        //},
        url: 'https://gnews.io/api/v4/search?q='+ticker+'&token='+myKey,
        withCreditals: true
    });
    console.log(feed);
    let posts = `<div id=articles>`;
    for(let i = 0; i < 2; i++) {
        // feed.data.articles[i].url !=null &&
        if( feed.data.articles[i].title!=null && feed.data.articles[i].image!=null && feed.data.articles[i].description!= null && feed.data.articles[i].source != null) {
        posts += `  <div class="box"> 
                    <div class="column">
                        <h1 class="title"><a href="${feed.data.articles[i].url}" target="_blank">${feed.data.articles[i].title}</a></h1>
                        <div class="columns is-mobile">
                            <div class="column">
                                <figure class="image">
                                    <img src="${feed.data.articles[i].image}">
                                </figure>
                                <br>
                            </div>
                            <div class="column">
                                <p>${feed.data.articles[i].description}</p>
                                <br>
                                <p>Author: ${feed.data.articles[i].source}</p>
                            </div>
                        </div>
                        <form method="get" name="form2" action="home.php"> 
                        <button name="save" type="submit"  id="save" value="${feed.data.articles[i].url}">Save Article <span class="icon is-medium"><i class="fa fa-heart"></i></span></button>
                        </form>
                        </div>
                    </div>`;   
        } 
    }
    posts += `</div>`;
    $root.append(posts);
}



export const renderSite = function() {
    const $root = $('#newsFeed');
    $(document).on('click', '#generate', generateNewsFeed);

}

$(function() {
    renderSite();
});

//        <br><br><a href="deleteConfirm.php"><input name="deleteUser" type="button" class="back" value="Delete Account"/><
