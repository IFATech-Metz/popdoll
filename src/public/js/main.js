/// Collection

let table = document.getElementById('collection')
if (table) {
  let by = 'title'
  let sort = 'asc'
  let view = 'list'
  if (window.localStorage) {
    console.log('localStorage', 'on')
    if (localStorage.getItem('view')) {
      view = localStorage.getItem('view')
      console.log('view', view)
    }
  }
  if (/\?.+$/.test(document.URL)) {
    let urlc = /\?(.+)$/.exec(document.URL)[1].split('&')
    urlc.forEach(e => {
      let cc = e.split('=')
      switch (cc[0]) {
        case 'order[by]':
        case 'order%5Bby%5D':
          by = cc[1]
          break;
        case 'order[sort]':
        case 'order%5Bsort%5D':
          sort = cc[1]
          break;
      }
    })
  }
  table.className = view

  let tools = document.createElement('div')
  tools.id = 'tools'
  let ts = '<form method="get" class="order"><label>Trier par</label><select name="order[by]"><option value="title"'
  if (by === 'title') ts += 'selected'
  ts += '>Titre</option><option value="category"'
  if (by === 'category') ts += 'selected'
  ts += '>Catégorie</option><option value="collection"'
  if (by === 'collection') ts += 'selected'
  ts += '>Collection</option></select><select name="order[sort]"><option value="asc"'
  if (sort === 'asc') ts += 'selected'
  ts += '>A &rarr; Z</option><option value="desc" '
  if (sort === 'desc') ts += 'selected'
  ts += '>Z &rarr; A</option></select></form>'
  + '<form class="view"><label>Vue</label><input type="radio" name="view" value="list"'
  if (view === 'list') ts += 'checked'
  ts += '/>Liste <input type="radio" name="view" value="grid"'
  if (view === 'grid') ts += 'checked'
  ts += ' />Grille</fieldset>'
  tools.innerHTML = ts
  table.before(tools)
  tools.querySelectorAll('select').forEach(elem => {
    elem.addEventListener('change', ev => {
      elem.form.submit()
    })
  })
  tools.querySelectorAll('input').forEach(elem => {
    elem.addEventListener('change', ev => {
      table.className = elem.value
      localStorage.setItem('view', elem.value)
    })
  })
}
if (document.querySelector('article.collection')) {
  let foot = document.createElement('footer')
  let add = document.createElement('a')
  add.href = '#add'
  add.innerHTML ='<span>Ajouter</span>'

  add.addEventListener('click', ev => {
    ev.preventDefault()
    add.setAttribute('style', 'display:none;')
    document.querySelector('body > header').className = 'small'
    let collection = document.getElementById('collection')
    let tools = document.getElementById('tools')

    let create = document.createElement('form')
    create.id = 'create'

    let search = document.createElement('input')
    search.type = 'search'
    search.name = 'search'
    search.setAttribute('placeholder', 'Rechercher')

    let ol = document.createElement('ol')
    ol.className = 'results'
    create.innerHTML = `<ol class="breadcrumb">
    <li><a href="./"><span>Collection</span></a></li>
    </ol>`
    create.appendChild(search)
    create.appendChild(ol) //<ol id="results"></ol>`
    collection.setAttribute('style','display:none;')
    tools.setAttribute('style','display:none;')
    document.querySelector('article.collection').appendChild(create)
    search.addEventListener('input', ev => {
      let query = ev.target.value
      if (query.length > 3) {
        fetch('https://www.funko.com/ui-api/search?text=' + query, {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(results => {
          if (results.ok && results.status === 200) {
            return results.json()
          }
          return false
        })
        .then(results => {
          if (results && results.products) {
            ol.innerHTML = ''
            results.products.forEach((product, i) => {
              console.log('product', i, product)
              if (/^Pop!/i.test(product.title)) {
                let li = document.createElement('li')
                let a = document.createElement('a')
                a.href = '#add'
                a.innerHTML = `<span>Ajouter</span>`
                li.innerHTML = `<img src="${product.image.src}"/><span>${product.title}</span>`
                a.remove()
                li.appendChild(a)
                a.addEventListener('click', ev => {
                  ev.preventDefault()
                  fetch('', {
                    method: 'POST',
                    body: JSON.stringify({
                      handle: product.handle
                    }),
                    headers: {
                      'Content-Type': 'application/json'
                    }
                  })
                  .then(() => tools.querySelector('form').submit())
                })
                ol.appendChild(li)
              }
            })
          }
        })
      }
    })
  })
  foot.appendChild(add)
  document.querySelector('article.collection').appendChild(foot)
}

/// Resource / Doll

let doll = document.querySelector('article.doll')
if (doll) {
  let foot = document.createElement('footer')
  let remove = document.createElement('a')
  remove.href = '#delete'
  remove.innerHTML = '<span>Supprimer</span>'
  foot.appendChild(remove)
  doll.appendChild(foot)
  remove.addEventListener('click', ev => {
    ev.preventDefault()
    fetch('', {
      method: 'DELETE'
    })
  })
  doll.querySelector('p.description').addEventListener('input', ev => {
    fetch('', {
      method: 'PATCH',
      body: JSON.stringify({
        description: ev.target.innerHTML.replace(/<br>/ig, '\n')
      }),
      headers: {
        'Content-Type': 'application/json'
      }
    })
  })
}

export function shout(string) {
  return null;
}
