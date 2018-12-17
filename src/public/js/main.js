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

/// Resource / Doll

let doll = document.querySelector('article.doll')
if (doll) {
  let foot = document.createElement('footer')
  foot.innerHTML = '<a href="#delete">Supprimer</a>'
  doll.appendChild(foot)
  doll.querySelectorAll('[contenteditable]').forEach(param => {
    // console.log('param', param)
    param.addEventListener('input', ev => {
      console.log('ev', ev, this.innerText)
    })
  })
}

export function shout(string) {
  return null;
}
