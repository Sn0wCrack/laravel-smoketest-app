import Alpine from 'alpinejs';
import { marked } from 'marked';

window.Alpine = Alpine;
window.marked = marked;

window.renderMarkdown = (text) => {
    if (!text) return '<p class="text-gray-400 italic">Nothing to preview</p>';
    return marked.parse(text);
}

Alpine.start();
