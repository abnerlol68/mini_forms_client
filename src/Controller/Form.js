export default class Controller {
  constructor() {
    this.url = document.getElementById('url').innerText;
    this.form = document.getElementById('form_id').innerText;
    this.questSet = this.requestQuests();
  }

  async requestQuests() {
    return fetch(`${this.url}request/?req=get_quests&form=${this.form}`)
      .then(quests => quests.json());
  }

  async getQuestSet() { return [... await this.questSet] }

  async getOptSet(questId) {
    return fetch(`${this.url}request/?req=get_options&quest=${questId}`)
      .then(quests => quests.json());
  }
}
