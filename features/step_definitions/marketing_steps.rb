Then /^marketing_metric (\d+) should have been updated$/ do |metric_id|
  metric = MarketingMetric.find_by_id(metric_id.to_i)
  metric.updated_at.should > metric.created_at
end

When /^I wait for (\d+) seconds?$/ do |seconds|
  sleep seconds.to_i
end
