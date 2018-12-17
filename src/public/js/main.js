/// Collection

let table = document.getElementById('collection')
if (table) {
  let by = 'title'
  let sort = 'asc'
  let view = 'list'
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
        case 'view':
          view = cc[1]
          break;
      }
    })
  } else if (window.localstorage) {
    // { by, sort, view } = JSON.parse(localStorage.getItem('order'))
  }
  let table = document.getElementById('collection')
  let tools = document.createElement('form')
  tools.method = 'get'
  let ts = '<fieldset class="order"><label>Trier par</label><select name="order[by]"><option value="title"'
  if (by === 'title') ts += 'selected'
  ts += '>Titre</option><option value="category"'
  if (by === 'category') ts += 'selected'
  ts += '>Catégorie</option><option value="collection"'
  if (by === 'collection') ts += 'selected'
  ts += '>Collection</option></select><select name="order[sort]"><option value="asc"'
  if (sort === 'asc') ts += 'selected'
  ts += '>A &rarr; Z</option><option value="desc" '
  if (sort === 'desc') ts += 'selected'
  ts += '>Z &rarr; A</option></select></fieldset>'
  + '<fieldset class="view"><label>Vue</label><input type="radio" name="view" value="list"'
  if (view === 'list') ts += 'checked'
  ts += '/>Liste <input type="radio" name="view" value="grid"'
  if (view === 'grid') ts += 'checked'
  ts += ' />Grille</fieldset>'
  tools.innerHTML = ts
  table.before(tools)
  tools.querySelectorAll('select, input').forEach(elem => {
    elem.addEventListener('change', ev => {
      tools.submit()
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
